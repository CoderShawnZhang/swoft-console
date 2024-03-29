<?php
/**
 * 终端命名事件标记
 */

namespace SwoftRewrite\Console;


final class ConsoleEvent
{
    public const RUN_BEFORE = 'console.run.before';
    public const DISPATCH_BEFORE = 'console.dispatch.before';
    public const EXECUTE_BEFORE = 'console.execute.before';
    public const EXECUTE_AFTER = 'console.execute.after';
    public const DISPATCH_AFTER = 'console.dispatch.after';
    public const RUN_AFTER = 'console.run.after';
    public const RUN_ERROR = 'console.run.error';
}