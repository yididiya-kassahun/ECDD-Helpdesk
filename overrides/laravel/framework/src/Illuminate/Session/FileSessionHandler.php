<?php

namespace Illuminate\Session;

use SessionHandlerInterface;
use Illuminate\Support\Carbon;
use Symfony\Component\Finder\Finder;
use Illuminate\Filesystem\Filesystem;

class FileSessionHandler implements SessionHandlerInterface
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The path where sessions should be stored.
     *
     * @var string
     */
    protected $path;

    /**
     * The number of minutes the session should be valid.
     *
     * @var int
     */
    protected $minutes;

    /**
     * Create a new file driven handler instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $path
     * @param  int  $minutes
     * @return void
     */
    public function __construct(Filesystem $files, $path, $minutes)
    {
        $this->path = $path;
        $this->files = $files;
        $this->minutes = $minutes;
    }

    /**
     * {@inheritdoc}
     */
    public function open($savePath, $sessionName): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function close(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     * : string|false
     */
    #[\ReturnTypeWillChange]
    public function read($sessionId)
    {
        if ($this->files->exists($path = $this->path.'/'.$sessionId)) {
            if (filemtime($path) >= Carbon::now()->subMinutes($this->minutes)->getTimestamp()) {
                return $this->files->get($path, true);
            }
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function write($sessionId, $data): bool
    {
        $this->files->put($this->path.'/'.$sessionId, $data, true);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($sessionId): bool
    {
        $this->files->delete($this->path.'/'.$sessionId);

        return true;
    }

    /**
     * {@inheritdoc}
     * : int|false
     */
    #[\ReturnTypeWillChange]
    public function gc($lifetime)
    {
        $files = Finder::create()
                    ->in($this->path)
                    ->files()
                    ->ignoreDotFiles(true)
                    ->date('<= now - '.$lifetime.' seconds');

        foreach ($files as $file) {
            $this->files->delete($file->getRealPath());
        }

        return false;
    }
}
