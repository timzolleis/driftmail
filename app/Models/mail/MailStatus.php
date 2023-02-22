<?php
namespace App\Models\mail;
abstract class MailStatus
{
    const WAITING = "waiting";
    const SENDING = "sending";
    const SENT = "sent";
    const FAILED = "failed";


}
