<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V31;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V31\Customer;

class RelationsRequest extends Request
{
    /**
     * Verkrijg debiteuren o.b.v. het meegestuurde filter. In deze versie heeft CountryCode een waarde.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     LoginName?: string|null,
     *     Id?: int|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: int|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: bool,
     * } $parameters
     *
     * @return array<array-key, Customer>
     *
     * @throws Logic4ApiException
     */
    public function getCustomers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Customer::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3.1/Relations/GetCustomers', ['json' => $parameters]),
            ),
        );
    }
}
