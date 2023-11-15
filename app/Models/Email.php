<?php

declare(strict_types=1);

namespace App\Models;

class Email extends Model
{
    // public function queue(
    //     Address $to,
    //     Address $from,
    //     string $subject,
    //     string $html,
    //     ?string $text = null
    // ): void {
    //     QueryBuilder::beginTransaction();

    //     try {
    //         QueryBuilder::table("emails")->insert([
    //             "subject" => $subject,
    //             "status" => EmailStatus::QUEUE,
    //             ""
    //         ]);

    //         QueryBuilder::commit();
    //     } catch (\Throwable $e) {
    //         // if (QueryBuilder::inTransaction()) {
    //         QueryBuilder::rollback();
    //         // }

    //         throw new \Exception($e->getMessage());
    //     }
    // }
}
