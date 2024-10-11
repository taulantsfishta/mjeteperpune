<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/discoveryengine/v1beta/search_service.proto

namespace Google\Cloud\DiscoveryEngine\V1beta\SearchResponse;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Guided search result. The guided search helps user to refine the search
 * results and narrow down to the real needs from a broaded search results.
 *
 * Generated from protobuf message <code>google.cloud.discoveryengine.v1beta.SearchResponse.GuidedSearchResult</code>
 */
class GuidedSearchResult extends \Google\Protobuf\Internal\Message
{
    /**
     * A list of ranked refinement attributes.
     *
     * Generated from protobuf field <code>repeated .google.cloud.discoveryengine.v1beta.SearchResponse.GuidedSearchResult.RefinementAttribute refinement_attributes = 1;</code>
     */
    private $refinement_attributes;
    /**
     * Suggested follow-up questions.
     *
     * Generated from protobuf field <code>repeated string follow_up_questions = 2;</code>
     */
    private $follow_up_questions;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\DiscoveryEngine\V1beta\SearchResponse\GuidedSearchResult\RefinementAttribute>|\Google\Protobuf\Internal\RepeatedField $refinement_attributes
     *           A list of ranked refinement attributes.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $follow_up_questions
     *           Suggested follow-up questions.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Discoveryengine\V1Beta\SearchService::initOnce();
        parent::__construct($data);
    }

    /**
     * A list of ranked refinement attributes.
     *
     * Generated from protobuf field <code>repeated .google.cloud.discoveryengine.v1beta.SearchResponse.GuidedSearchResult.RefinementAttribute refinement_attributes = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRefinementAttributes()
    {
        return $this->refinement_attributes;
    }

    /**
     * A list of ranked refinement attributes.
     *
     * Generated from protobuf field <code>repeated .google.cloud.discoveryengine.v1beta.SearchResponse.GuidedSearchResult.RefinementAttribute refinement_attributes = 1;</code>
     * @param array<\Google\Cloud\DiscoveryEngine\V1beta\SearchResponse\GuidedSearchResult\RefinementAttribute>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRefinementAttributes($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\DiscoveryEngine\V1beta\SearchResponse\GuidedSearchResult\RefinementAttribute::class);
        $this->refinement_attributes = $arr;

        return $this;
    }

    /**
     * Suggested follow-up questions.
     *
     * Generated from protobuf field <code>repeated string follow_up_questions = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getFollowUpQuestions()
    {
        return $this->follow_up_questions;
    }

    /**
     * Suggested follow-up questions.
     *
     * Generated from protobuf field <code>repeated string follow_up_questions = 2;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setFollowUpQuestions($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->follow_up_questions = $arr;

        return $this;
    }

}

