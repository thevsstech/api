<?php
/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 0.0.1
 */
namespace Tmdb\Repository;

use Tmdb\Api\People;
use Tmdb\Factory\PeopleFactory;
use Tmdb\Model\Person;
use Tmdb\Model\Person\QueryParameter\AppendToResponse;

class PeopleRepository extends AbstractRepository {
    /**
     * Load a person with the given identifier
     *
     * @param $id
     * @param array $parameters
     * @param array $headers
     * @return Person
     */
    public function load($id, array $parameters = array(), array $headers = array()) {

        if (empty($parameters) && $parameters !== false) {
            // Load a no-nonsense default set
            $parameters = array(
                new AppendToResponse(array(
                    AppendToResponse::IMAGES,
                    AppendToResponse::CHANGES,
                    AppendToResponse::COMBINED_CREDITS,
                    AppendToResponse::MOVIE_CREDITS,
                    AppendToResponse::TV_CREDITS,
                ))
            );
        }

        $data = $this->getApi()->getPerson($id, $this->parseQueryParameters($parameters), $this->parseHeaders($headers));

        return $this->getFactory()->create($data);
    }

    /**
     * Return the related API class
     *
     * @return \Tmdb\Api\People
     */
    public function getApi()
    {
        return $this->getClient()->getPeopleApi();
    }

    /**
     * @return PeopleFactory
     */
    public function getFactory()
    {
        return new PeopleFactory();
    }
}
