<?php

namespace NF_FU_LIB;

// This file was auto-generated from sdk-root/src/data/elastic-inference/2017-07-25/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2017-07-25', 'endpointPrefix' => 'api.elastic-inference', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceAbbreviation' => 'Amazon Elastic Inference', 'serviceFullName' => 'Amazon Elastic Inference', 'serviceId' => 'Elastic Inference', 'signatureVersion' => 'v4', 'signingName' => 'elastic-inference', 'uid' => 'elastic-inference-2017-07-25'], 'operations' => ['ListTagsForResource' => ['name' => 'ListTagsForResource', 'http' => ['method' => 'GET', 'requestUri' => '/tags/{resourceArn}'], 'input' => ['shape' => 'ListTagsForResourceRequest'], 'output' => ['shape' => 'ListTagsForResourceResult'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'TagResource' => ['name' => 'TagResource', 'http' => ['method' => 'POST', 'requestUri' => '/tags/{resourceArn}'], 'input' => ['shape' => 'TagResourceRequest'], 'output' => ['shape' => 'TagResourceResult'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'UntagResource' => ['name' => 'UntagResource', 'http' => ['method' => 'DELETE', 'requestUri' => '/tags/{resourceArn}'], 'input' => ['shape' => 'UntagResourceRequest'], 'output' => ['shape' => 'UntagResourceResult'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]]], 'shapes' => ['BadRequestException' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 400], 'exception' => \true], 'InternalServerException' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 500], 'exception' => \true], 'ListTagsForResourceRequest' => ['type' => 'structure', 'required' => ['resourceArn'], 'members' => ['resourceArn' => ['shape' => 'ResourceARN', 'location' => 'uri', 'locationName' => 'resourceArn']]], 'ListTagsForResourceResult' => ['type' => 'structure', 'members' => ['tags' => ['shape' => 'TagMap']]], 'ResourceARN' => ['type' => 'string', 'max' => 1011, 'min' => 1], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 404], 'exception' => \true], 'String' => ['type' => 'string'], 'TagKey' => ['type' => 'string', 'max' => 128, 'min' => 1], 'TagKeyList' => ['type' => 'list', 'member' => ['shape' => 'TagKey'], 'max' => 50, 'min' => 1], 'TagMap' => ['type' => 'map', 'key' => ['shape' => 'TagKey'], 'value' => ['shape' => 'TagValue'], 'max' => 50, 'min' => 1], 'TagResourceRequest' => ['type' => 'structure', 'required' => ['resourceArn', 'tags'], 'members' => ['resourceArn' => ['shape' => 'ResourceARN', 'location' => 'uri', 'locationName' => 'resourceArn'], 'tags' => ['shape' => 'TagMap']]], 'TagResourceResult' => ['type' => 'structure', 'members' => []], 'TagValue' => ['type' => 'string', 'max' => 256], 'UntagResourceRequest' => ['type' => 'structure', 'required' => ['resourceArn', 'tagKeys'], 'members' => ['resourceArn' => ['shape' => 'ResourceARN', 'location' => 'uri', 'locationName' => 'resourceArn'], 'tagKeys' => ['shape' => 'TagKeyList', 'location' => 'querystring', 'locationName' => 'tagKeys']]], 'UntagResourceResult' => ['type' => 'structure', 'members' => []]]];