<?php

declare(strict_types=1);

use BinSoul\CodingStandard\MultilineLambdaFunctionArgumentsFixer;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
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
use PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\Configuration\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::CACHE_DIRECTORY, __DIR__ . '/.cache/ecs');
    $parameters->set(Option::INDENTATION, '    ');
    $parameters->set(Option::LINE_ENDING, "\n");

    $parameters->set(Option::SETS, [
        SetList::PHP_70,
        SetList::PHP_71,
        SetList::COMMON,
        SetList::CLEAN_CODE,
        SetList::DEAD_CODE,
        SetList::PSR_12,
    ]);

    $parameters->set(Option::SKIP, [AssignmentInConditionSniff::class => null, PhpUnitStrictFixer::class => null, ReturnAssignmentFixer::class => null]);

    $services = $containerConfigurator->services();

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
    $services->set(PhpdocToCommentFixer::class);
    $services->set(PhpdocTrimFixer::class);
    $services->set(PhpdocTypesFixer::class);
    $services->set(PhpdocVarWithoutNameFixer::class);
    $services->set(PhpdocNoAliasTagFixer::class);
    $services->set(PhpUnitMethodCasingFixer::class)
        ->call('configure', [['case' => 'snake_case']]);

    $services->set(BlankLineBeforeStatementFixer::class)
        ->call('configure', [['statements' => ['break', 'case', 'continue', 'do', 'for', 'foreach', 'if', 'return', 'switch', 'throw', 'try', 'while', 'yield']]]);

    $services->set(IncrementStyleFixer::class)
        ->call('configure', [['style' => 'post']]);

    $services->set(MultilineLambdaFunctionArgumentsFixer::class);
};
