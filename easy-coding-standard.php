<?php

declare(strict_types=1);

use BinSoul\CodingStandard\MultilineLambdaFunctionArgumentsFixer;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocInlineTagFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAccessFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoUselessInheritdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use SlevomatCodingStandard\Sniffs\Whitespaces\DuplicateSpacesSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\Configuration\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::CACHE_DIRECTORY, __DIR__ . '/.cache/ecs');
    $parameters->set(Option::INDENTATION, '    ');
    $parameters->set(Option::LINE_ENDING, "\n");

    $parameters->set(
        Option::SETS,
        [
            'php70',
            'php71',
            'common',
            'clean-code',
            'dead-code',
            'psr12',
            'doctrine-annotations',
        ]
    );

    $parameters->set(
        Option::SKIP,
        [
            AssignmentInConditionSniff::class => null,
            PhpUnitStrictFixer::class => null,
            ReturnAssignmentFixer::class => null,
            UnaryOperatorSpacesFixer::class => null,
        ]
    );

    $services = $containerConfigurator->services();

    // PHPDoc
    $services->set(PhpdocAlignFixer::class)
        ->call('configure', [['tags' => ['method', 'param', 'property', 'return', 'throws', 'type', 'var']]]);

    $services->set(NoBlankLinesAfterPhpdocFixer::class);
    $services->set(NoEmptyPhpdocFixer::class);
    $services->set(PhpdocSeparationFixer::class);
    $services->set(PhpdocAnnotationWithoutDotFixer::class);
    $services->set(PhpdocIndentFixer::class);
    $services->set(PhpdocInlineTagFixer::class);
    $services->set(PhpdocNoAccessFixer::class);
    $services->set(PhpdocNoEmptyReturnFixer::class);
    $services->set(PhpdocNoPackageFixer::class);
    $services->set(PhpdocNoUselessInheritdocFixer::class);
    $services->set(PhpdocReturnSelfReferenceFixer::class);
    $services->set(PhpdocScalarFixer::class);
    $services->set(PhpdocSingleLineVarSpacingFixer::class);
    $services->set(PhpdocSummaryFixer::class);
    $services->set(PhpdocTrimFixer::class);
    $services->set(PhpdocTypesFixer::class);
    $services->set(PhpdocVarWithoutNameFixer::class);
    $services->set(PhpdocNoAliasTagFixer::class);
    $services->set(NoSuperfluousPhpdocTagsFixer::class);

    // PHPUnit
    $services->set(PhpUnitMethodCasingFixer::class)
        ->call('configure', [['case' => 'snake_case']]);

    // Whitespace
    $services->set(BlankLineBeforeStatementFixer::class)
        ->call('configure', [['statements' => ['break', 'case', 'continue', 'do', 'for', 'foreach', 'if', 'return', 'switch', 'throw', 'try', 'while', 'yield']]]);

    $services->set(NoExtraBlankLinesFixer::class)
        ->call('configure', [['tokens' => ['break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'switch', 'throw', 'use', 'use_trait']]]);

    $services->set(IncrementStyleFixer::class)
        ->call('configure', [['style' => 'post']]);

    $services->set(DuplicateSpacesSniff::class)->property('ignoreSpacesInAnnotation', true);

    // Operators
    $services->set(NotOperatorWithSuccessorSpaceFixer::class);

    // Import
    $services->set(FullyQualifiedStrictTypesFixer::class);
    $services->set(NoUnusedImportsFixer::class);
    $services->set(OrderedImportsFixer::class);
    $services->set(GlobalNamespaceImportFixer::class)->call('configure', [['import_classes' => true]]);

    // Classes
    $services->set(OrderedClassElementsFixer::class);

    // Custom
    $services->set(MultilineLambdaFunctionArgumentsFixer::class);
};
