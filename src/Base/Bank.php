<?php

namespace Billplz\Base;

use Billplz\Request;
use Laravie\Codex\Contracts\Response;

abstract class Bank extends Request
{
    /**
     * Get A Bank Account.
     *
     * @param  string  $accountNumber
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function get(string $accountNumber)
    {
        return $this->send('GET', "bank_verification_services/{$accountNumber}");
    }

    /**
     * Create A Bank Account.
     *
     * @param  string  $name
     * @param  string  $identification
     * @param  string  $accountNumber
     * @param  string  $code
     * @param  bool $organization
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function createAccount(
        string $name,
        string $identification,
        string $accountNumber,
        string $code,
        bool $organization
    ): Response {
        $body = compact('name', 'code', 'organization');
        $body['id_no'] = $identification;
        $body['acc_no'] = $accountNumber;

        return $this->send('POST', 'bank_verification_services', [], $body);
    }

    /**
     * Check Bank Account Number.
     *
     * @param  string  $accountNumber
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function checkAccount(string $accountNumber): Response
    {
        return $this->send('GET', "check/bank_account_number/{$accountNumber}");
    }

    /**
     * Get list of bank for Bank Direct Feature.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function supportedForFpx(): Response
    {
        return $this->send('GET', 'fpx_banks');
    }
}
