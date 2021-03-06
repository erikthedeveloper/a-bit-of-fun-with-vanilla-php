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

    function it_builds_callable_method_from_validate_rule_name()
    {
        $this->translateRuleNameToMethodName('email')->shouldReturn('validateEmail');
        $this->translateRuleNameToMethodName('not_empty')->shouldReturn('validateNotEmpty');
        //$this->translateRuleNameToMethodName('min:8')->shouldReturn('validateMin');
        $this->shouldThrow('\InvalidArgumentException')->during('getCallableMethodFromRuleName', ['not_a_valid_rule_name']);
    }

    function it_validates_an_email_address()
    {
        $this->validateEmail('joejoe.com')->shouldReturn(false);
        $this->validateEmail('joe@joe.com')->shouldReturn(true);
        $this->validateEmail('joe@joecom')->shouldReturn(false);
    }

    function it_validates_not_empty()
    {
        $this->validateNotEmpty('')->shouldReturn(false);
        $this->validateNotEmpty('hello there')->shouldReturn(true);
    }

    function it_validates_each_field_with_a_given_array_of_callables()
    {
        // TODO: How to mock/stub method on "subject". (i.e. $this->validateUsingRule(rule, field_name, value)->shouldBeCalledTimes(3)
        $this->validate(
            [
                'email'    => ['email'],
                'password' => ['not_empty']
            ],
            [
                'email'    => '',
                'password' => 'foobar'
            ]
        )->shouldHaveErrors();
    }

    function it_can_also_accept_a_closure_in_place_of_validation_rule()
    {
        $custom_callable_validation = function ($value) {
            return $value == 'johnny';
        };
        $this->validate(
            ['a_field' => [$custom_callable_validation]],
            ['a_field' => 'not_joe']
        )->shouldHaveErrors();
        $this->clearValidations();
        $this->validate(
            ['a_field' => [$custom_callable_validation]],
            ['a_field' => 'johnny']
        )->shouldNotHaveErrors();
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
}
