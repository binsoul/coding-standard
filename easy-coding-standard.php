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
use PhpCsFixer\Fixer\Phpdoc\PhpdocInlineTagNormalizerFixer;
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
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $config): void {
    $parameters = $config->parameters();

    $parameters->set(Option::CACHE_DIRECTORY, __DIR__ . '/.cache/ecs');
    $config->indentation( '    ');
    $config->lineEnding("\n");

    $config->sets([SetList::COMMON, SetList::CLEAN_CODE, SetList::PSR_12, SetList::DOCTRINE_ANNOTATIONS]);

    $config->skip(
        [
            AssignmentInConditionSniff::class => null,
            PhpUnitStrictFixer::class => null,
            ReturnAssignmentFixer::class => null,
            UnaryOperatorSpacesFixer::class => null,
            ArrayOpenerAndCloserNewlineFixer::class => null,
            ArrayListItemNewlineFixer::class => null,
        ]
    );

    // PHPDoc
    $config->ruleWithConfiguration(PhpdocAlignFixer::class, ['tags' => ['method', 'param', 'property', 'return', 'throws', 'type', 'var']]);

    $config->rule(NoBlankLinesAfterPhpdocFixer::class);
    $config->rule(NoEmptyPhpdocFixer::class);
    $config->rule(PhpdocSeparationFixer::class);
    $config->rule(PhpdocAnnotationWithoutDotFixer::class);
    $config->rule(PhpdocIndentFixer::class);
    $config->rule(PhpdocInlineTagNormalizerFixer::class);
    $config->rule(PhpdocNoAccessFixer::class);
    $config->rule(PhpdocNoEmptyReturnFixer::class);
    $config->rule(PhpdocNoPackageFixer::class);
    $config->rule(PhpdocNoUselessInheritdocFixer::class);
    $config->rule(PhpdocReturnSelfReferenceFixer::class);
    $config->rule(PhpdocScalarFixer::class);
    $config->rule(PhpdocSingleLineVarSpacingFixer::class);
    $config->rule(PhpdocSummaryFixer::class);
    $config->rule(PhpdocTrimFixer::class);
    $config->rule(PhpdocTypesFixer::class);
    $config->rule(PhpdocVarWithoutNameFixer::class);
    $config->rule(PhpdocNoAliasTagFixer::class);
    $config->rule(NoSuperfluousPhpdocTagsFixer::class);

    // PHPUnit
    $config->ruleWithConfiguration(PhpUnitMethodCasingFixer::class, ['case' => 'snake_case']);

    // Whitespace
    $config->ruleWithConfiguration(
        BlankLineBeforeStatementFixer::class,
        ['statements' => ['break', 'case', 'continue', 'do', 'for', 'foreach', 'if', 'return', 'switch', 'throw', 'try', 'while', 'yield']]
    );

    $config->ruleWithConfiguration(
        NoExtraBlankLinesFixer::class,
        ['tokens' => ['break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'switch', 'throw', 'use', 'use_trait']]
    );

    $config->ruleWithConfiguration(
        IncrementStyleFixer::class,
        ['style' => 'post']
    );

    $config->ruleWithConfiguration(
        DuplicateSpacesSniff::class, ['ignoreSpacesInAnnotation'=>true]
    );

    $config->rule(ArrayOpenerAndCloserNewlineFixer::class);

    // Operators
    $config->rule(NotOperatorWithSuccessorSpaceFixer::class);

    // Import
    $config->rule(FullyQualifiedStrictTypesFixer::class);
    $config->rule(NoUnusedImportsFixer::class);
    $config->rule(OrderedImportsFixer::class);
    $config->ruleWithConfiguration(GlobalNamespaceImportFixer::class, ['import_classes' => true]);

    // Classes
    $config->rule(OrderedClassElementsFixer::class);

    // Custom
    $config->rule(MultilineLambdaFunctionArgumentsFixer::class);
};
