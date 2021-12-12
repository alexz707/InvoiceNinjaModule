<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use InvoiceNinjaModule\Model\Interfaces\InvitationInterface;
use InvoiceNinjaModule\Model\Invitation;
use Laminas\Hydrator\Exception\BadMethodCallException;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\StrategyInterface;
use function is_array;

/**
 * Class InvitationsStrategy
 */
final class InvitationsStrategy implements StrategyInterface
{
    private HydratorInterface $hydrator;

    /**
     * InvitationsStrategy constructor.
     *
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param InvitationInterface[]  $value  The original value.
     *
     * @return array Returns the value that should be extracted.
     * @throws BadMethodCallException for a non-object $contactObj
     */
    public function extract($value, ?object $object = null): array
    {
        $result = [];
        foreach ($value as $invitation) {
            if ($invitation instanceof InvitationInterface) {
                $result[] = $this->hydrator->extract($invitation);
            }
        }
        return $result;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     * @param array $value
     *
     * @return InvitationInterface[]
     * @throws BadMethodCallException for a non-object $contactObj
     */
    public function hydrate($value, ?array $data) :array
    {
        $result = [];
        if (is_array($value)) {
            foreach ($value as $invitationArr) {
                $invitation = new Invitation();
                $this->hydrator->hydrate($invitationArr, $invitation);
                $result[] = $invitation;
            }
        }
        return $result;
    }
}
