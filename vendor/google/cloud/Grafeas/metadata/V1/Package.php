<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: grafeas/v1/package.proto

namespace GPBMetadata\Grafeas\V1;

class Package
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Grafeas\V1\Common::initOnce();
        $pool->internalAddGeneratedFile(
            '
�

grafeas/v1/package.proto
grafeas.v1grafeas/v1/common.proto"�
Distribution
cpe_uri (	B�A.
architecture (2.grafeas.v1.Architecture+
latest_version (2.grafeas.v1.Version

maintainer (	
url (	
description (	"O
Location
cpe_uri (	$
version (2.grafeas.v1.Version
path (	"�
PackageNote
name (	B�A�A.
distribution
 (2.grafeas.v1.Distribution
package_type (	
cpe_uri (	.
architecture (2.grafeas.v1.Architecture$
version (2.grafeas.v1.Version

maintainer (	
url (	
description (	$
license (2.grafeas.v1.License"
digest (2.grafeas.v1.Digest"�
PackageOccurrence
name (	B�A�A&
location (2.grafeas.v1.Location
package_type (	B�A
cpe_uri (	B�A3
architecture (2.grafeas.v1.ArchitectureB�A$
license (2.grafeas.v1.License)
version (2.grafeas.v1.VersionB�A"�
Version
epoch (
name (	
revision (	
	inclusive (-
kind (2.grafeas.v1.Version.VersionKind
	full_name (	"Q
VersionKind
VERSION_KIND_UNSPECIFIED 

NORMAL
MINIMUM
MAXIMUM*>
Architecture
ARCHITECTURE_UNSPECIFIED 
X86
X64BQ
io.grafeas.v1PZ8google.golang.org/genproto/googleapis/grafeas/v1;grafeas�GRAbproto3'
        , true);

        static::$is_initialized = true;
    }
}

