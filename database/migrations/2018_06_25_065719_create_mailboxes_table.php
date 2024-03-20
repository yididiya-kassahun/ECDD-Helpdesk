<?php

use App\Mailbox;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // https://developer.helpscout.com/mailbox-api/endpoints/mailboxes/get/
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            // Not used
            $table->string('slug', 16)->unique()->nullable();
            $table->string('email', 128)->unique();
            $table->string('aliases', 255)->nullable();
            $table->unsignedTinyInteger('from_name')->default(Mailbox::FROM_NAME_MAILBOX);
            $table->string('from_name_custom', 128)->nullable();
            $table->unsignedTinyInteger('ticket_status')->default(Mailbox::TICKET_STATUS_PENDING);
            $table->unsignedTinyInteger('ticket_assignee')->default(Mailbox::TICKET_ASSIGNEE_REPLYING_UNASSIGNED);
            $table->unsignedTinyInteger('template')->default(Mailbox::TEMPLATE_FANCY);
            $table->text('signature')->nullable();
            $table->unsignedTinyInteger('out_method')->default(Mailbox::OUT_METHOD_PHP_MAIL);
            $table->string('out_server', 255)->nullable();
            $table->string('out_username', 100)->nullable();
            $table->text('out_password')->nullable();
            $table->unsignedInteger('out_port')->nullable();
            $table->unsignedTinyInteger('out_encryption')->default(Mailbox::OUT_ENCRYPTION_NONE);
            $table->string('in_server', 255)->nullable();
            $table->unsignedInteger('in_port')->default(143); // default IMAP port
            $table->string('in_username', 100)->nullable();
            $table->text('in_password')->nullable();
            $table->unsignedTinyInteger('in_protocol')->default(Mailbox::IN_PROTOCOL_IMAP);
            $table->unsignedTinyInteger('in_encryption')->default(Mailbox::IN_ENCRYPTION_NONE);
            $table->boolean('auto_reply_enabled')->default(false);
            $table->string('auto_reply_subject', 128)->nullable();
            $table->text('auto_reply_message')->nullable();
            // todo
            $table->boolean('office_hours_enabled')->default(false);
            $table->boolean('ratings')->default(false);
            $table->unsignedTinyInteger('ratings_placement')->default(Mailbox::RATINGS_PLACEMENT_ABOVE);
            $table->text('ratings_text')->nullable();
            // todo: translate ratings
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailboxes');
    }
}
