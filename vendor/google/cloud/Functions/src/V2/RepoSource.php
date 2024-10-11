<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/functions/v2/functions.proto

namespace Google\Cloud\Functions\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Location of the source in a Google Cloud Source Repository.
 *
 * Generated from protobuf message <code>google.cloud.functions.v2.RepoSource</code>
 */
class RepoSource extends \Google\Protobuf\Internal\Message
{
    /**
     * ID of the project that owns the Cloud Source Repository. If omitted, the
     * project ID requesting the build is assumed.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     */
    private $project_id = '';
    /**
     * Name of the Cloud Source Repository.
     *
     * Generated from protobuf field <code>string repo_name = 2;</code>
     */
    private $repo_name = '';
    /**
     * Directory, relative to the source root, in which to run the build.
     * This must be a relative path. If a step's `dir` is specified and is an
     * absolute path, this value is ignored for that step's execution.
     * eg. helloworld (no leading slash allowed)
     *
     * Generated from protobuf field <code>string dir = 6;</code>
     */
    private $dir = '';
    /**
     * Only trigger a build if the revision regex does NOT match the revision
     * regex.
     *
     * Generated from protobuf field <code>bool invert_regex = 7;</code>
     */
    private $invert_regex = false;
    protected $revision;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $branch_name
     *           Regex matching branches to build.
     *           The syntax of the regular expressions accepted is the syntax accepted by
     *           RE2 and described at https://github.com/google/re2/wiki/Syntax
     *     @type string $tag_name
     *           Regex matching tags to build.
     *           The syntax of the regular expressions accepted is the syntax accepted by
     *           RE2 and described at https://github.com/google/re2/wiki/Syntax
     *     @type string $commit_sha
     *           Explicit commit SHA to build.
     *     @type string $project_id
     *           ID of the project that owns the Cloud Source Repository. If omitted, the
     *           project ID requesting the build is assumed.
     *     @type string $repo_name
     *           Name of the Cloud Source Repository.
     *     @type string $dir
     *           Directory, relative to the source root, in which to run the build.
     *           This must be a relative path. If a step's `dir` is specified and is an
     *           absolute path, this value is ignored for that step's execution.
     *           eg. helloworld (no leading slash allowed)
     *     @type bool $invert_regex
     *           Only trigger a build if the revision regex does NOT match the revision
     *           regex.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Functions\V2\Functions::initOnce();
        parent::__construct($data);
    }

    /**
     * Regex matching branches to build.
     * The syntax of the regular expressions accepted is the syntax accepted by
     * RE2 and described at https://github.com/google/re2/wiki/Syntax
     *
     * Generated from protobuf field <code>string branch_name = 3;</code>
     * @return string
     */
    public function getBranchName()
    {
        return $this->readOneof(3);
    }

    public function hasBranchName()
    {
        return $this->hasOneof(3);
    }

    /**
     * Regex matching branches to build.
     * The syntax of the regular expressions accepted is the syntax accepted by
     * RE2 and described at https://github.com/google/re2/wiki/Syntax
     *
     * Generated from protobuf field <code>string branch_name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setBranchName($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Regex matching tags to build.
     * The syntax of the regular expressions accepted is the syntax accepted by
     * RE2 and described at https://github.com/google/re2/wiki/Syntax
     *
     * Generated from protobuf field <code>string tag_name = 4;</code>
     * @return string
     */
    public function getTagName()
    {
        return $this->readOneof(4);
    }

    public function hasTagName()
    {
        return $this->hasOneof(4);
    }

    /**
     * Regex matching tags to build.
     * The syntax of the regular expressions accepted is the syntax accepted by
     * RE2 and described at https://github.com/google/re2/wiki/Syntax
     *
     * Generated from protobuf field <code>string tag_name = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setTagName($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Explicit commit SHA to build.
     *
     * Generated from protobuf field <code>string commit_sha = 5;</code>
     * @return string
     */
    public function getCommitSha()
    {
        return $this->readOneof(5);
    }

    public function hasCommitSha()
    {
        return $this->hasOneof(5);
    }

    /**
     * Explicit commit SHA to build.
     *
     * Generated from protobuf field <code>string commit_sha = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setCommitSha($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * ID of the project that owns the Cloud Source Repository. If omitted, the
     * project ID requesting the build is assumed.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * ID of the project that owns the Cloud Source Repository. If omitted, the
     * project ID requesting the build is assumed.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setProjectId($var)
    {
        GPBUtil::checkString($var, True);
        $this->project_id = $var;

        return $this;
    }

    /**
     * Name of the Cloud Source Repository.
     *
     * Generated from protobuf field <code>string repo_name = 2;</code>
     * @return string
     */
    public function getRepoName()
    {
        return $this->repo_name;
    }

    /**
     * Name of the Cloud Source Repository.
     *
     * Generated from protobuf field <code>string repo_name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setRepoName($var)
    {
        GPBUtil::checkString($var, True);
        $this->repo_name = $var;

        return $this;
    }

    /**
     * Directory, relative to the source root, in which to run the build.
     * This must be a relative path. If a step's `dir` is specified and is an
     * absolute path, this value is ignored for that step's execution.
     * eg. helloworld (no leading slash allowed)
     *
     * Generated from protobuf field <code>string dir = 6;</code>
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Directory, relative to the source root, in which to run the build.
     * This must be a relative path. If a step's `dir` is specified and is an
     * absolute path, this value is ignored for that step's execution.
     * eg. helloworld (no leading slash allowed)
     *
     * Generated from protobuf field <code>string dir = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setDir($var)
    {
        GPBUtil::checkString($var, True);
        $this->dir = $var;

        return $this;
    }

    /**
     * Only trigger a build if the revision regex does NOT match the revision
     * regex.
     *
     * Generated from protobuf field <code>bool invert_regex = 7;</code>
     * @return bool
     */
    public function getInvertRegex()
    {
        return $this->invert_regex;
    }

    /**
     * Only trigger a build if the revision regex does NOT match the revision
     * regex.
     *
     * Generated from protobuf field <code>bool invert_regex = 7;</code>
     * @param bool $var
     * @return $this
     */
    public function setInvertRegex($var)
    {
        GPBUtil::checkBool($var);
        $this->invert_regex = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getRevision()
    {
        return $this->whichOneof("revision");
    }

}

