<?php

namespace NF_FU_LIB;

// This file was auto-generated from sdk-root/src/data/transcribe/2017-10-26/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2017-10-26', 'endpointPrefix' => 'transcribe', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'Amazon Transcribe Service', 'serviceId' => 'Transcribe', 'signatureVersion' => 'v4', 'signingName' => 'transcribe', 'targetPrefix' => 'Transcribe', 'uid' => 'transcribe-2017-10-26'], 'operations' => ['CreateVocabulary' => ['name' => 'CreateVocabulary', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateVocabularyRequest'], 'output' => ['shape' => 'CreateVocabularyResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'ConflictException']]], 'CreateVocabularyFilter' => ['name' => 'CreateVocabularyFilter', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateVocabularyFilterRequest'], 'output' => ['shape' => 'CreateVocabularyFilterResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'ConflictException']]], 'DeleteTranscriptionJob' => ['name' => 'DeleteTranscriptionJob', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteTranscriptionJobRequest'], 'errors' => [['shape' => 'LimitExceededException'], ['shape' => 'BadRequestException'], ['shape' => 'InternalFailureException']]], 'DeleteVocabulary' => ['name' => 'DeleteVocabulary', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteVocabularyRequest'], 'errors' => [['shape' => 'NotFoundException'], ['shape' => 'LimitExceededException'], ['shape' => 'BadRequestException'], ['shape' => 'InternalFailureException']]], 'DeleteVocabularyFilter' => ['name' => 'DeleteVocabularyFilter', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteVocabularyFilterRequest'], 'errors' => [['shape' => 'NotFoundException'], ['shape' => 'LimitExceededException'], ['shape' => 'BadRequestException'], ['shape' => 'InternalFailureException']]], 'GetTranscriptionJob' => ['name' => 'GetTranscriptionJob', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetTranscriptionJobRequest'], 'output' => ['shape' => 'GetTranscriptionJobResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'NotFoundException']]], 'GetVocabulary' => ['name' => 'GetVocabulary', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetVocabularyRequest'], 'output' => ['shape' => 'GetVocabularyResponse'], 'errors' => [['shape' => 'NotFoundException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'BadRequestException']]], 'GetVocabularyFilter' => ['name' => 'GetVocabularyFilter', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetVocabularyFilterRequest'], 'output' => ['shape' => 'GetVocabularyFilterResponse'], 'errors' => [['shape' => 'NotFoundException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'BadRequestException']]], 'ListTranscriptionJobs' => ['name' => 'ListTranscriptionJobs', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListTranscriptionJobsRequest'], 'output' => ['shape' => 'ListTranscriptionJobsResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException']]], 'ListVocabularies' => ['name' => 'ListVocabularies', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListVocabulariesRequest'], 'output' => ['shape' => 'ListVocabulariesResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException']]], 'ListVocabularyFilters' => ['name' => 'ListVocabularyFilters', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListVocabularyFiltersRequest'], 'output' => ['shape' => 'ListVocabularyFiltersResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException']]], 'StartTranscriptionJob' => ['name' => 'StartTranscriptionJob', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'StartTranscriptionJobRequest'], 'output' => ['shape' => 'StartTranscriptionJobResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'ConflictException']]], 'UpdateVocabulary' => ['name' => 'UpdateVocabulary', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdateVocabularyRequest'], 'output' => ['shape' => 'UpdateVocabularyResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'NotFoundException'], ['shape' => 'ConflictException']]], 'UpdateVocabularyFilter' => ['name' => 'UpdateVocabularyFilter', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdateVocabularyFilterRequest'], 'output' => ['shape' => 'UpdateVocabularyFilterResponse'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'LimitExceededException'], ['shape' => 'InternalFailureException'], ['shape' => 'NotFoundException']]]], 'shapes' => ['BadRequestException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'FailureReason']], 'exception' => \true], 'Boolean' => ['type' => 'boolean'], 'ConflictException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'exception' => \true], 'CreateVocabularyFilterRequest' => ['type' => 'structure', 'required' => ['VocabularyFilterName', 'LanguageCode'], 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'Words' => ['shape' => 'Words'], 'VocabularyFilterFileUri' => ['shape' => 'Uri']]], 'CreateVocabularyFilterResponse' => ['type' => 'structure', 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'LastModifiedTime' => ['shape' => 'DateTime']]], 'CreateVocabularyRequest' => ['type' => 'structure', 'required' => ['VocabularyName', 'LanguageCode'], 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'Phrases' => ['shape' => 'Phrases'], 'VocabularyFileUri' => ['shape' => 'Uri']]], 'CreateVocabularyResponse' => ['type' => 'structure', 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'VocabularyState' => ['shape' => 'VocabularyState'], 'LastModifiedTime' => ['shape' => 'DateTime'], 'FailureReason' => ['shape' => 'FailureReason']]], 'DataAccessRoleArn' => ['type' => 'string', 'pattern' => '^arn:aws:iam::[0-9]{0,63}:role/[A-Za-z0-9:_/+=,@.-]{0,1023}$'], 'DateTime' => ['type' => 'timestamp'], 'DeleteTranscriptionJobRequest' => ['type' => 'structure', 'required' => ['TranscriptionJobName'], 'members' => ['TranscriptionJobName' => ['shape' => 'TranscriptionJobName']]], 'DeleteVocabularyFilterRequest' => ['type' => 'structure', 'required' => ['VocabularyFilterName'], 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName']]], 'DeleteVocabularyRequest' => ['type' => 'structure', 'required' => ['VocabularyName'], 'members' => ['VocabularyName' => ['shape' => 'VocabularyName']]], 'FailureReason' => ['type' => 'string'], 'GetTranscriptionJobRequest' => ['type' => 'structure', 'required' => ['TranscriptionJobName'], 'members' => ['TranscriptionJobName' => ['shape' => 'TranscriptionJobName']]], 'GetTranscriptionJobResponse' => ['type' => 'structure', 'members' => ['TranscriptionJob' => ['shape' => 'TranscriptionJob']]], 'GetVocabularyFilterRequest' => ['type' => 'structure', 'required' => ['VocabularyFilterName'], 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName']]], 'GetVocabularyFilterResponse' => ['type' => 'structure', 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'LastModifiedTime' => ['shape' => 'DateTime'], 'DownloadUri' => ['shape' => 'Uri']]], 'GetVocabularyRequest' => ['type' => 'structure', 'required' => ['VocabularyName'], 'members' => ['VocabularyName' => ['shape' => 'VocabularyName']]], 'GetVocabularyResponse' => ['type' => 'structure', 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'VocabularyState' => ['shape' => 'VocabularyState'], 'LastModifiedTime' => ['shape' => 'DateTime'], 'FailureReason' => ['shape' => 'FailureReason'], 'DownloadUri' => ['shape' => 'Uri']]], 'InternalFailureException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'exception' => \true, 'fault' => \true], 'JobExecutionSettings' => ['type' => 'structure', 'members' => ['AllowDeferredExecution' => ['shape' => 'Boolean'], 'DataAccessRoleArn' => ['shape' => 'DataAccessRoleArn']]], 'KMSKeyId' => ['type' => 'string', 'max' => 2048, 'min' => 1, 'pattern' => '^[A-Za-z0-9][A-Za-z0-9:_/+=,@.-]{0,2048}$'], 'LanguageCode' => ['type' => 'string', 'enum' => ['en-US', 'es-US', 'en-AU', 'fr-CA', 'en-GB', 'de-DE', 'pt-BR', 'fr-FR', 'it-IT', 'ko-KR', 'es-ES', 'en-IN', 'hi-IN', 'ar-SA', 'ru-RU', 'zh-CN', 'nl-NL', 'id-ID', 'ta-IN', 'fa-IR', 'en-IE', 'en-AB', 'en-WL', 'pt-PT', 'te-IN', 'tr-TR', 'de-CH', 'he-IL', 'ms-MY', 'ja-JP', 'ar-AE']], 'LimitExceededException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'exception' => \true], 'ListTranscriptionJobsRequest' => ['type' => 'structure', 'members' => ['Status' => ['shape' => 'TranscriptionJobStatus'], 'JobNameContains' => ['shape' => 'TranscriptionJobName'], 'NextToken' => ['shape' => 'NextToken'], 'MaxResults' => ['shape' => 'MaxResults']]], 'ListTranscriptionJobsResponse' => ['type' => 'structure', 'members' => ['Status' => ['shape' => 'TranscriptionJobStatus'], 'NextToken' => ['shape' => 'NextToken'], 'TranscriptionJobSummaries' => ['shape' => 'TranscriptionJobSummaries']]], 'ListVocabulariesRequest' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'NextToken'], 'MaxResults' => ['shape' => 'MaxResults'], 'StateEquals' => ['shape' => 'VocabularyState'], 'NameContains' => ['shape' => 'VocabularyName']]], 'ListVocabulariesResponse' => ['type' => 'structure', 'members' => ['Status' => ['shape' => 'TranscriptionJobStatus'], 'NextToken' => ['shape' => 'NextToken'], 'Vocabularies' => ['shape' => 'Vocabularies']]], 'ListVocabularyFiltersRequest' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'NextToken'], 'MaxResults' => ['shape' => 'MaxResults'], 'NameContains' => ['shape' => 'VocabularyFilterName']]], 'ListVocabularyFiltersResponse' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'NextToken'], 'VocabularyFilters' => ['shape' => 'VocabularyFilters']]], 'MaxAlternatives' => ['type' => 'integer', 'max' => 10, 'min' => 2], 'MaxResults' => ['type' => 'integer', 'max' => 100, 'min' => 1], 'MaxSpeakers' => ['type' => 'integer', 'max' => 10, 'min' => 2], 'Media' => ['type' => 'structure', 'members' => ['MediaFileUri' => ['shape' => 'Uri']]], 'MediaFormat' => ['type' => 'string', 'enum' => ['mp3', 'mp4', 'wav', 'flac']], 'MediaSampleRateHertz' => ['type' => 'integer', 'max' => 48000, 'min' => 8000], 'NextToken' => ['type' => 'string', 'max' => 8192, 'pattern' => '.+'], 'NotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'exception' => \true], 'OutputBucketName' => ['type' => 'string', 'max' => 64, 'pattern' => '[a-z0-9][\\.\\-a-z0-9]{1,61}[a-z0-9]'], 'OutputLocationType' => ['type' => 'string', 'enum' => ['CUSTOMER_BUCKET', 'SERVICE_BUCKET']], 'Phrase' => ['type' => 'string', 'max' => 256, 'min' => 0, 'pattern' => '.+'], 'Phrases' => ['type' => 'list', 'member' => ['shape' => 'Phrase']], 'Settings' => ['type' => 'structure', 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'ShowSpeakerLabels' => ['shape' => 'Boolean'], 'MaxSpeakerLabels' => ['shape' => 'MaxSpeakers'], 'ChannelIdentification' => ['shape' => 'Boolean'], 'ShowAlternatives' => ['shape' => 'Boolean'], 'MaxAlternatives' => ['shape' => 'MaxAlternatives'], 'VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'VocabularyFilterMethod' => ['shape' => 'VocabularyFilterMethod']]], 'StartTranscriptionJobRequest' => ['type' => 'structure', 'required' => ['TranscriptionJobName', 'LanguageCode', 'Media'], 'members' => ['TranscriptionJobName' => ['shape' => 'TranscriptionJobName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'MediaSampleRateHertz' => ['shape' => 'MediaSampleRateHertz'], 'MediaFormat' => ['shape' => 'MediaFormat'], 'Media' => ['shape' => 'Media'], 'OutputBucketName' => ['shape' => 'OutputBucketName'], 'OutputEncryptionKMSKeyId' => ['shape' => 'KMSKeyId'], 'Settings' => ['shape' => 'Settings'], 'JobExecutionSettings' => ['shape' => 'JobExecutionSettings']]], 'StartTranscriptionJobResponse' => ['type' => 'structure', 'members' => ['TranscriptionJob' => ['shape' => 'TranscriptionJob']]], 'String' => ['type' => 'string'], 'Transcript' => ['type' => 'structure', 'members' => ['TranscriptFileUri' => ['shape' => 'Uri']]], 'TranscriptionJob' => ['type' => 'structure', 'members' => ['TranscriptionJobName' => ['shape' => 'TranscriptionJobName'], 'TranscriptionJobStatus' => ['shape' => 'TranscriptionJobStatus'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'MediaSampleRateHertz' => ['shape' => 'MediaSampleRateHertz'], 'MediaFormat' => ['shape' => 'MediaFormat'], 'Media' => ['shape' => 'Media'], 'Transcript' => ['shape' => 'Transcript'], 'StartTime' => ['shape' => 'DateTime'], 'CreationTime' => ['shape' => 'DateTime'], 'CompletionTime' => ['shape' => 'DateTime'], 'FailureReason' => ['shape' => 'FailureReason'], 'Settings' => ['shape' => 'Settings'], 'JobExecutionSettings' => ['shape' => 'JobExecutionSettings']]], 'TranscriptionJobName' => ['type' => 'string', 'max' => 200, 'min' => 1, 'pattern' => '^[0-9a-zA-Z._-]+'], 'TranscriptionJobStatus' => ['type' => 'string', 'enum' => ['QUEUED', 'IN_PROGRESS', 'FAILED', 'COMPLETED']], 'TranscriptionJobSummaries' => ['type' => 'list', 'member' => ['shape' => 'TranscriptionJobSummary']], 'TranscriptionJobSummary' => ['type' => 'structure', 'members' => ['TranscriptionJobName' => ['shape' => 'TranscriptionJobName'], 'CreationTime' => ['shape' => 'DateTime'], 'StartTime' => ['shape' => 'DateTime'], 'CompletionTime' => ['shape' => 'DateTime'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'TranscriptionJobStatus' => ['shape' => 'TranscriptionJobStatus'], 'FailureReason' => ['shape' => 'FailureReason'], 'OutputLocationType' => ['shape' => 'OutputLocationType']]], 'UpdateVocabularyFilterRequest' => ['type' => 'structure', 'required' => ['VocabularyFilterName'], 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'Words' => ['shape' => 'Words'], 'VocabularyFilterFileUri' => ['shape' => 'Uri']]], 'UpdateVocabularyFilterResponse' => ['type' => 'structure', 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'LastModifiedTime' => ['shape' => 'DateTime']]], 'UpdateVocabularyRequest' => ['type' => 'structure', 'required' => ['VocabularyName', 'LanguageCode'], 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'Phrases' => ['shape' => 'Phrases'], 'VocabularyFileUri' => ['shape' => 'Uri']]], 'UpdateVocabularyResponse' => ['type' => 'structure', 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'LastModifiedTime' => ['shape' => 'DateTime'], 'VocabularyState' => ['shape' => 'VocabularyState']]], 'Uri' => ['type' => 'string', 'max' => 2000, 'min' => 1, 'pattern' => '(s3://|http(s*)://).+'], 'Vocabularies' => ['type' => 'list', 'member' => ['shape' => 'VocabularyInfo']], 'VocabularyFilterInfo' => ['type' => 'structure', 'members' => ['VocabularyFilterName' => ['shape' => 'VocabularyFilterName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'LastModifiedTime' => ['shape' => 'DateTime']]], 'VocabularyFilterMethod' => ['type' => 'string', 'enum' => ['remove', 'mask']], 'VocabularyFilterName' => ['type' => 'string', 'max' => 200, 'min' => 1, 'pattern' => '^[0-9a-zA-Z._-]+'], 'VocabularyFilters' => ['type' => 'list', 'member' => ['shape' => 'VocabularyFilterInfo']], 'VocabularyInfo' => ['type' => 'structure', 'members' => ['VocabularyName' => ['shape' => 'VocabularyName'], 'LanguageCode' => ['shape' => 'LanguageCode'], 'LastModifiedTime' => ['shape' => 'DateTime'], 'VocabularyState' => ['shape' => 'VocabularyState']]], 'VocabularyName' => ['type' => 'string', 'max' => 200, 'min' => 1, 'pattern' => '^[0-9a-zA-Z._-]+'], 'VocabularyState' => ['type' => 'string', 'enum' => ['PENDING', 'READY', 'FAILED']], 'Word' => ['type' => 'string', 'max' => 256, 'min' => 1], 'Words' => ['type' => 'list', 'member' => ['shape' => 'Word'], 'min' => 1]]];