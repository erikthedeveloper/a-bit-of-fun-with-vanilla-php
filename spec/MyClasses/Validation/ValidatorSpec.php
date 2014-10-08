<?php

namespace spec\MyClasses\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ValidatorSpec
 * @package spec\MyClasses\Validation
 * @author  Erik Aybar
 * @mixin \MyClasses\Validation\Validator
 */
class ValidatorSpec extends ObjectBehavior
{

    /**
     * @author Erik Aybar
     * @deprecated skipping test my prepending method name with "old_"
     */
    function old_it_validates_using_the_old_ugly_method()
    {
        $this->validate(
            [
                'email'    => "/\w+/",
                'password' => "/\w+/"
            ],
            [
                'email'    => '',
                'password' => 'foobar'
            ]
        )->shouldHaveErrors();
    }

    function it_validates_each_field_with_a_given_array_of_callables()
    {
        $this->validate(
            [
                'email'    => ['not_empty'],
                'password' => ['not_empty']
            ],
            [
                'email'    => '',
                'password' => 'foobar'
            ]
        )->shouldHaveErrors();
    }

    function it_validates_an_email_address()
    {
        $this->validate(
            ['email' => ['email']],
            ['email' => 'joe@joe.com']
        )->shouldHaveValidData();
    }

    function it_allows_multiple_validation_rules_per_field()
    {
        $this->validate(
            ['email' => ['not_empty', 'email']],
            ['email' => '']
        )->shouldHaveErrors();
        $this->clearValidations();
        $this->validate(
            ['email' => ['not_empty', 'email']],
            ['email' => 'not_an_email here']
        )->shouldHaveErrors();
        $this->clearValidations();
        $this->validate(
            ['email' => ['not_empty', 'email']],
            ['email' => 'joe@joe.com']
        )->shouldHaveValidData();
    }

    function it_builds_callable_method_from_validate_rule_name()
    {
        $this->getCallableRuleFromName('email')->shouldReturn('validateEmail');
        $this->getCallableRuleFromName('not_empty')->shouldReturn('validateNotEmpty');
    }
}
