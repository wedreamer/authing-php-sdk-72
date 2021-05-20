<?php

declare(strict_types=1);

use PHPStan\Type\ArrayType;
use Rector\Set\ValueObject\SetList;
use Rector\Core\Configuration\Option;
use SebastianBergmann\Type\MixedType;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\DowngradeSetList;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
use Rector\CodeQuality\Rector\For_\ForToForeachRector;
use Rector\DowngradePhp73\Tokenizer\FollowedByCommaAnalyzer;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;
use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddArrayParamDocTypeRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\Param\ParamTypeFromStrictTypedPropertyRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();

    // Define what rule sets will be applied
    // $parameters->set(Option::SETS, [
    //     SetList::DEAD_CODE,
    // ]);

    // $parameters->set(Option::SKIP, [
    //     __DIR__ . '/src/Types/CodeGen.v2.php',
    // ]);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        // __DIR__ . '/tests'
    ]);

    // here we can define, what sets of rules will be applied
    $parameters->set(Option::SETS, [
        // DowngradeSetList::PHP_72,
        // SetList::PHP_52,
        // SetList::PHP_53,
        // SetList::PHP_54,
        // SetList::PHP_55,
        // SetList::PHP_56,
        // SetList::PHP_70,
        // SetList::PHP_71,
        // SetList::PHP_72,

        // SetList::PHP_73,
        // SetList::PHP_72,
        // SetList::PHP_72,
        // SetList::PHP_72,
        // SetList::PHP_72,
        // SetList::PHP_72,
    ]);

    // vendor/bin/rector process --dry-run
    // is your PHP version different from the one your refactor to? [default: your PHP version]
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);

    // get services (needed for register a single rule)
    $services = $containerConfigurator->services();

    // register a single rule
    $services->set(AddArrayParamDocTypeRector::class);
    // $services->set(ParamTypeDeclarationRector::class);
    $services->set(ArrayMergeOfNonArraysToSimpleArrayRector::class);
    $services->set(ChangeArrayPushToArrayAssignRector::class);
    $services->set(CompactToVariablesRector::class);
    $services->set(CompleteDynamicPropertiesRector::class);
    $services->set(ForRepeatedCountToOwnVariableRector::class);
    $services->set(ForToForeachRector::class);
    $services->set(IssetOnPropertyObjectToPropertyExistsRector::class);
    $services->set(ForToForeachRector::class);
    
    // $services->set(
    //     ParamTypeDeclarationRector::class);
};
