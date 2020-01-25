<?php

namespace App\Models;

/**
 * @property int $senderId
 * @property int $receiverId
 * @property string $fromName
 * @property string $fromEmail
 * @property string $fromPhone
 * @property string $contactTime
 * @property string $message
 * @property string $receiverEmail
 * @property string $receiverName
 * @property string $address
 * @property string $job
 * @property string $company
 * @property boolean $includeAdmin
 */
class Inquiry
{
    public $senderId;
    public $receiverId;
    public $fromName;
    public $fromEmail;
    public $fromPhone;
    public $contactTime;
    public $message;
    public $receiverEmail;
    public $receiverName;
    public $address;
    public $job;
    public $company;
    public $includeAdmin = false;
}
