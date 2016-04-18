<?php

namespace BiberLtd\Bundle\SubscriptionManagemenBundle\Services;

/** Extends CoreModel */
use BiberLtd\Bundle\CoreBundle\CoreModel;

/** Required for better & instant error handling for the support team */
use BiberLtd\Bundle\CoreBundle\Exceptions as CoreExceptions;
use BiberLtd\Bundle\CoreBundle\Responses\ModelResponse;
use BiberLtd\Bundle\SiteManagementBundle\Exceptions as BundleExceptions;

/** Entities to be used */
use BiberLtd\Bundle\SubscriptionManagemenBundle\Entity as BundleEntity;

/** Helper Models */
use BiberLtd\Bundle\MemberManagementBundle\Services as MMBService;

class SubscriptionManagementModel extends CoreModel{

    /**
     * SubscriptionManagementModel constructor.
     * @param object $kernel
     * @param string $dbConnection
     * @param string $orm
     */
    public function __construct($kernel, $dbConnection = 'default', $orm = 'doctrine'){
        parent::__construct($kernel, $dbConnection, $orm);

        /**
         * Register entity names for easy reference.
         */
        $this->entity = array(
            'sm'   => array('name' => 'SubscriptionManagementBundle:Subscription', 'alias' => 'sm'),
            'sp'  => array('name' => 'SubscriptionManagementBundle:SubscriptionPackage', 'alias' => 'sp'),
        );
    }

    /**
     * Destructor
     */
    public function __destruct(){
        foreach($this as $property => $value) {
            $this->$property = null;
        }
    }

    /**
     * @param mixed $subscription
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function insertSubscription($subscription){
        return $this->insertSubscriptions(array($subscription));
    }

    /**
     * @param array $collection
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function insertSubscriptions(array $collection)
    {
        $timeStamp = microtime(true);
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countInserts = 0;
        $insertedItems = [];
        $now = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));

        foreach ($collection as $data) {
            if ($data instanceof BundleEntity\Subscription) {
                $entity = $data;
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            } else if (is_object($data)) {
                $entity = new BundleEntity\Subscription;
                if (!property_exists($data, 'date_added')) {
                    $data->date_added = $now;
                }
                if (!property_exists($data, 'date_updated')) {
                    $data->date_updated = $now;
                }
                foreach ($data as $column => $value) {

                    $set = 'set' . $this->translateColumnName($column);
                    switch ($column) {
                        case 'member':
                            $mModel = $this->kernel->getContainer()->get('membermanagement.model');
                            $response = $mModel->getMember($value);
                            if (!$response->error->exist) {
                                $entity->$set($response->result->set);
                            }
                            unset($response, $mModel);
                            break;
                        case 'package':
                            $pModel = $this->kernel->getContainer()->get('subscriptionmanagement.model');
                            $response = $pModel->getSubscriptionPackage($value);
                            if (!$response->error->exist) {
                                $entity->$set($response->result->set);
                            }
                            unset($response, $pModel);
                            break;
                        default:
                            $entity->$set($value);
                            break;
                    }

                }
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            }
        }
        if ($countInserts > 0) {
            $this->em->flush();
            return new ModelResponse($insertedItems, $countInserts, 0, null, false, 'S:D:003', 'Selected entries have been successfully inserted into database.', $timeStamp, microtime(true));
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:003', 'One or more entities cannot be inserted into database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $subscription
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function updateSubscription($subscription){
        return $this->updateSubscriptions(array($subscription));
    }

    /**
     * @param array $collection
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function updateSubscriptions(array $collection)
    {
        $timeStamp = microtime(true);
        $countUpdates = 0;
        $updatedItems = [];
        $now = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));
        foreach ($collection as $data) {
            if ($data instanceof BundleEntity\Subscription) {
                $entity = $data;
                $this->em->persist($entity);
                $updatedItems[] = $entity;
                $countUpdates++;
            } else if (is_object($data)) {
                if (!property_exists($data, 'id') || !is_numeric($data->id)) {
                    return $this->createException('InvalidParameter', 'Each data must contain a valid identifier id, integer', 'err.invalid.parameter.collection');
                }
                if (!property_exists($data, 'date_updated')) {
                    $data->date_updated = $now;
                }
                if (property_exists($data, 'date_added')) {
                    unset($data->date_added);
                }
                $response = $this->getSubscription($data->id);
                if ($response->error->exist) {
                    return $this->createException('EntityDoesNotExist', 'Subscription with id ' . $data->id, 'err.invalid.entity');
                }
                $oldEntity = $response->result->set;

                foreach ($data as $column => $value) {
                    $set = 'set' . $this->translateColumnName($column);
                    switch ($column) {
                        case 'member':
                            $mModel = $this->kernel->getContainer()->get('membermanagement.model');
                            $response = $mModel->getMember($value);
                            if (!$response->error->exist) {
                                $entity->$set($response->result->set);
                            }
                            unset($response, $mModel);
                            break;
                        case 'package':
                            $pModel = $this->kernel->getContainer()->get('subscriptionmanagement.model');
                            $response = $pModel->getSubscriptionPackage($value);
                            if (!$response->error->exist) {
                                $entity->$set($response->result->set);
                            }
                            unset($response, $pModel);
                            break;
                        default:
                            $entity->$set($value);
                            break;
                    }
                    if ($oldEntity->isModified()) {
                        $this->em->persist($oldEntity);
                        $countUpdates++;
                        $updatedItems[] = $oldEntity;
                    }
                }
            }
        }
        if ($countUpdates > 0) {
            $this->em->flush();
            return new ModelResponse($updatedItems, $countUpdates, 0, null, false, 'S:D:004', 'Selected entries have been successfully updated within database.', $timeStamp, microtime(true));
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:004', 'One or more entities cannot be updated within database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $subscription
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function deleteSubscription($subscription)
    {
        return $this->deleteSubscriptions(array($subscription));
    }

    /**
     * @param array $collection
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function deleteSubscriptions(array $collection)
    {
        $timeStamp = microtime(true);
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countDeleted = 0;
        foreach ($collection as $entry) {
            if ($entry instanceof BundleEntity\Subscription) {
                $this->em->remove($entry);
                $countDeleted++;
            } else {
                $response = $this->getSubscription($entry);
                if (!$response->error->exist) {
                    $this->em->remove($response->result->set);
                    $countDeleted++;
                }
            }
        }
        if ($countDeleted < 0) {
            return new ModelResponse(null, 0, 0, null, true, 'E:E:001', 'Unable to delete all or some of the selected entries.', $timeStamp, microtime(true));
        }
        $this->em->flush();
        return new ModelResponse(null, 0, 0, null, false, 'S:D:001', 'Selected entries have been successfully removed from database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $subscription
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function getSubscription($subscription){

        $timeStamp = microtime(true);
        if ($subscription instanceof BundleEntity\Subscription) {
            return new ModelResponse($subscription, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, microtime(true));
        }
        $result = null;
        switch ($subscription) {
            case is_numeric($subscription):
                $result = $this->em->getRepository($this->entity['sm']['name'])->findOneBy(array('id' => $subscription));
                break;
        }
        if (is_null($result)) {
            return new ModelResponse($result, 0, 0, null, true, 'E:D:002', 'Unable to find request entry in database.', $timeStamp, microtime(true));
        }
        return new ModelResponse($result, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, microtime(true));;

    }

    /**
     * @param mixed $subscriptionPackage
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function insertSubscriptionPackage($subscriptionPackage){
        return $this->insertSubscriptionPackages(array($subscriptionPackage));
    }

    /**
     * @param array $collection
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function insertSubscriptionPackages(array $collection){
        $timeStamp = microtime(true);
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countInserts = 0;
        $insertedItems = [];
        $now = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));

        foreach ($collection as $data) {
            if ($data instanceof BundleEntity\SubscriptionPackage) {
                $entity = $data;
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            } else if (is_object($data)) {
                $entity = new BundleEntity\SubscriptionPackage;
                if (!property_exists($data, 'date_added')) {
                    $data->date_added = $now;
                }
                if (!property_exists($data, 'date_updated')) {
                    $data->date_updated = $now;
                }
                foreach ($data as $column => $value) {
                    $set = 'set' . $this->translateColumnName($column);
                    switch ($column) {
                        default:
                            $entity->$set($value);
                            break;
                    }
                }
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            }
        }
        if ($countInserts > 0) {
            $this->em->flush();
            return new ModelResponse($insertedItems, $countInserts, 0, null, false, 'S:D:003', 'Selected entries have been successfully inserted into database.', $timeStamp, microtime(true));
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:003', 'One or more entities cannot be inserted into database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $subscriptionPackage
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function updateSubscriptionPackage($subscriptionPackage){
        return $this->updateSubscriptionPackages(array($subscriptionPackage));
    }

    /**
     * @param array $collection
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function updateSubscriptionPackages(array $collection){
        $timeStamp = microtime(true);
        $countUpdates = 0;
        $updatedItems = [];
        $now = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));
        foreach ($collection as $data) {
            if ($data instanceof BundleEntity\SubscriptionPackage) {
                $entity = $data;
                $this->em->persist($entity);
                $updatedItems[] = $entity;
                $countUpdates++;
            } else if (is_object($data)) {
                if (!property_exists($data, 'id') || !is_numeric($data->id)) {
                    return $this->createException('InvalidParameter', 'Each data must contain a valid identifier id, integer', 'err.invalid.parameter.collection');
                }
                if (!property_exists($data, 'date_updated')) {
                    $data->date_updated = $now;
                }
                if (property_exists($data, 'date_added')) {
                    unset($data->date_added);
                }
                $response = $this->getSubscription($data->id);
                if ($response->error->exist) {
                    return $this->createException('EntityDoesNotExist', 'Subscription with id ' . $data->id, 'err.invalid.entity');
                }
                $oldEntity = $response->result->set;

                foreach ($data as $column => $value) {
                    $set = 'set' . $this->translateColumnName($column);
                    switch ($column) {
                        default:
                            $entity->$set($value);
                            break;
                    }
                    if ($oldEntity->isModified()) {
                        $this->em->persist($oldEntity);
                        $countUpdates++;
                        $updatedItems[] = $oldEntity;
                    }
                }
            }
        }
        if ($countUpdates > 0) {
            $this->em->flush();
            return new ModelResponse($updatedItems, $countUpdates, 0, null, false, 'S:D:004', 'Selected entries have been successfully updated within database.', $timeStamp, microtime(true));
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:004', 'One or more entities cannot be updated within database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $subscription
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function deleteSubscriptionPackage($subscription)
    {
        return $this->deleteSubscriptionPackages(array($subscription));
    }

    /**
     * @param array $collection
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function deleteSubscriptionPackages(array $collection)
    {
        $timeStamp = microtime(true);
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countDeleted = 0;
        foreach ($collection as $entry) {
            if ($entry instanceof BundleEntity\SubscriptionPackage) {
                $this->em->remove($entry);
                $countDeleted++;
            } else {
                $response = $this->getSubscription($entry);
                if (!$response->error->exist) {
                    $this->em->remove($response->result->set);
                    $countDeleted++;
                }
            }
        }
        if ($countDeleted < 0) {
            return new ModelResponse(null, 0, 0, null, true, 'E:E:001', 'Unable to delete all or some of the selected entries.', $timeStamp, microtime(true));
        }
        $this->em->flush();
        return new ModelResponse(null, 0, 0, null, false, 'S:D:001', 'Selected entries have been successfully removed from database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $subscriptionPackage
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function getSubscriptionPackage($subscriptionPackage){
        $timeStamp = microtime(true);
        if ($subscriptionPackage instanceof BundleEntity\SubscriptionPackage) {
            return new ModelResponse($subscriptionPackage, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, microtime(true));
        }
        $result = null;
        switch ($subscriptionPackage) {
            case is_numeric($subscriptionPackage):
                $result = $this->em->getRepository($this->entity['sp']['name'])->findOneBy(array('id' => $subscriptionPackage));
                break;
        }
        if (is_null($result)) {
            return new ModelResponse($result, 0, 0, null, true, 'E:D:002', 'Unable to find request entry in database.', $timeStamp, microtime(true));
        }
        return new ModelResponse($result, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, microtime(true));;

    }

    /**
     * @param array|null $filter
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listSubscriptions(array $filter = null , array $sortOrder = null,array  $limit = null){
        $timeStamp = microtime(true);
        if (!is_array($sortOrder) && !is_null($sortOrder)) {
            return $this->createException('InvalidSortOrderException', '$sortOrder must be an array with key => value pairs where value can only be "asc" or "desc".', 'E:S:002');
        }
        $oStr = $wStr = $gStr = $fStr = '';

        $qStr = 'SELECT ' . $this->entity['sm']['alias'] . ' FROM ' . $this->entity['sm']['name'];

        if (!is_null($sortOrder)) {
            foreach ($sortOrder as $column => $direction) {
                switch ($column) {
                    case 'id':
                    case 'member':
                    case 'price':
                    case 'date_start':
                    case 'date_end':
                    case 'date_cancel':
                    case 'status':
                    case 'package':
                    case 'promotion':
                    case 'payment_status':
                    case 'remaining_amount':
                }
                $oStr .= ' ' . $column . ' ' . strtoupper($direction) . ', ';
            }
            $oStr = rtrim($oStr, ', ');
            $oStr = ' ORDER BY ' . $oStr . ' ';
        }

        if (!is_null($filter)) {
            $fStr = $this->prepareWhere($filter);
            $wStr .= ' WHERE ' . $fStr;
        }

        $qStr .= $wStr . $gStr . $oStr;
        $q = $this->em->createQuery($qStr);
        $q = $this->addLimit($q, $limit);

        $result = $q->getResult();

        $entities = [];
        foreach ($result as $entry) {
            $id = $entry->getSubscription()->getId();
            if (!isset($unique[$id])) {
                $unique[$id] = '';
                $entities[] = $entry->getSubscription();
            }
        }
        $totalRows = count($entities);
        if ($totalRows < 1) {
            return new ModelResponse(null, 0, 0, null, true, 'E:D:002', 'No entries found in database that matches to your criterion.', $timeStamp, microtime(true));
        }
        return new ModelResponse($entities, $totalRows, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, microtime(true));
    }

    /**
     * @param mixed $member
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listSubscriptionsOfMember($member, array $sortOrder = null, array $limit = null){

        $mModel = new MMBService\Member($this->kernel, $this->dbConnection, $this->orm);
        $response = $mModel->getMember($member);
        if ($response->error->exist) {
            return $response;
        }
        $member = $response->result->set;
        $column = $this->entity['sm']['alias'] . '.member';
        $condition = array('column' => $column, 'comparison' => '=', 'value' => $member->getId());
        $filter[] = array(
            'glue' => 'and',
            'condition' => array(
                array(
                    'glue' => 'and',
                    'condition' => $condition,
                )
            )
        );
        return $this->listSubscriptions($filter, $sortOrder, $limit);

    }

    /**
     * @param array|null $filter
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listActiveSubscriptions(array $filter = null, array $sortOrder = null, array $limit= null){
        $filter[] = array(
            'glue' => 'and',
            'condition' => array('column' => $this->entity['sm']['alias'].'.status', 'comparison' => '=', 'value' =>'a' ),
        );
        return $this->listSubscriptions($filter,$sortOrder,$limit);
    }

    /**
     * @param array|null $filter
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listInActiveSubscription(array $filter = null, array $sortOrder = null, array $limit= null){
        $filter[] = array(
            'glue' => 'and',
            'condition' => array('column' => $this->entity['sm']['alias'].'.status', 'comparison' => '=', 'value' =>'i' ),
        );
        return $this->listSubscriptions($filter,$sortOrder,$limit);
    }

    /**
     * @param array|null $filter
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listCanceledSubscription(array $filter = null, array $sortOrder = null, array $limit= null){
        $filter[] = array(
            'glue' => 'and',
            'condition' => array('column' => $this->entity['sm']['alias'].'.status', 'comparison' => '=', 'value' =>'c' ),
        );
        return $this->listSubscriptions($filter,$sortOrder,$limit);
    }

    /**
     * @param mixed $subscriptionPackage
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listSubscriptionsOfSubscriptionPackage($subscriptionPackage, array $sortOrder = null, array $limit = null){

        $response = $this->getSubscriptionPackage($subscriptionPackage);
        if ($response->error->exist) {
            return $response;
        }
        $subscriptionPackage = $response->result->set;
        $column = $this->entity['sm']['alias'] . '.package';
        $condition = array('column' => $column, 'comparison' => '=', 'value' => $subscriptionPackage->getId());
        $filter[] = array(
            'glue' => 'and',
            'condition' => array(
                array(
                    'glue' => 'and',
                    'condition' => $condition,
                )
            )
        );
        return $this->listSubscriptions($filter, $sortOrder, $limit);
    }

    /**
     * @param array $filter
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return \BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function listSubscriptionPackages(array $filter = array() , array $sortOrder = null,array  $limit = null){
        $timeStamp = microtime(true);
        if (!is_array($sortOrder) && !is_null($sortOrder)) {
            return $this->createException('InvalidSortOrderException', '$sortOrder must be an array with key => value pairs where value can only be "asc" or "desc".', 'E:S:002');
        }
        $oStr = $wStr = $gStr = $fStr = '';

        $qStr = 'SELECT ' . $this->entity['sp']['alias'] . ' FROM ' . $this->entity['sp']['name'];

        if (!is_null($sortOrder)) {
            foreach ($sortOrder as $column => $direction) {
                switch ($column) {
                    case 'id':
                    case 'code':
                    case 'fee':
                    case 'type':
                }
                $oStr .= ' ' . $column . ' ' . strtoupper($direction) . ', ';
            }
            $oStr = rtrim($oStr, ', ');
            $oStr = ' ORDER BY ' . $oStr . ' ';
        }

        if (!empty($filter)) {
            $fStr = $this->prepareWhere($filter);
            $wStr .= ' WHERE ' . $fStr;
        }

        $qStr .= $wStr . $gStr . $oStr;
        $q = $this->em->createQuery($qStr);
        $q = $this->addLimit($q, $limit);

        $result = $q->getResult();

        $entities = [];
        foreach ($result as $entry) {
            $id = $entry->getSubscriptionPackage()->getId();
            if (!isset($unique[$id])) {
                $unique[$id] = '';
                $entities[] = $entry->getSubscriptionPackage();
            }
        }
        $totalRows = count($entities);
        if ($totalRows < 1) {
            return new ModelResponse(null, 0, 0, null, true, 'E:D:002', 'No entries found in database that matches to your criterion.', $timeStamp, microtime(true));
        }
        return new ModelResponse($entities, $totalRows, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, microtime(true));
    }

    /**
     * @param string $type
     * @param array|null $filter
     * @param array|null $sortOrder
     * @param array|null $limit
     * @return ModelResponse
     */
    public function listSubscriptionPackageOfType($type, array $filter = null, array $sortOrder = null, array $limit= null){
        $timeStamp = microtime(true);

        if($type = 'd' || $type = 'w' || $type = 'm' || $type = 'y'){
            $filter[] = array(
                'glue' => 'and',
                'condition' => array('column' => $this->entity['sp']['alias'].'.type', 'comparison' => '=', 'value' => $type ), //type can be (d)ay,(w)eek,(m)ount,(y)year
            );
            return $this->listSubscriptionPackages($filter,$sortOrder,$limit);
        }else{
            return new ModelResponse(null, 0, 0, null, true, 'E:D:002', 'No entries found in database that matches to your criterion.', $timeStamp, microtime(true));
        }
    }

}