<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmailStatus;
use Illuminate\Database\Capsule\Manager as QueryBuilder;
use Symfony\Component\Mime\Address;

class Email
{
    public function queue(
        Address $to,
        Address $from,
        string $subject,
        string $html,
        ?string $text = null
    ): void {
        QueryBuilder::beginTransaction();

        try {
            QueryBuilder::table("emails")->insert([
                "subject" => $subject,
                "status" => EmailStatus::QUEUE,
                ""
            ]);

            QueryBuilder::commit();
        } catch (\Throwable $e) {
            // if (QueryBuilder::inTransaction()) {
            QueryBuilder::rollback();
            // }

            throw new \Exception($e->getMessage());
        }
    }
}
