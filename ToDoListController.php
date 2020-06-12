<?php

// ======================================================================
// セッションを使用してTODOリストを管理するクラスです.
// 今後DBを使用した管理に移行した場合の影響範囲 (修正範囲) を局所化するために
// TODOリストの管理は本クラスでのみ実施します.
// ======================================================================
class ToDoListController
{
    // セッションキーを定義します
    private const SESSION_KEY_NAME = 'todolist';

    // ======================================================================
    // TODOを追加します
    // ======================================================================
    public static function addToDo(Todo $todo)
    {
        $todoList = array();
        if (isset($_SESSION[self::SESSION_KEY_NAME])) {
            $todoList = $_SESSION[self::SESSION_KEY_NAME];
        }
        array_push($todoList, $todo);
        $_SESSION[self::SESSION_KEY_NAME] = $todoList;
    }

    // ======================================================================
    // TODOを削除します
    // ======================================================================
    public static function removeToDo(Todo $pTodo)
    {
        $todoList = array();
        if (isset($_SESSION[self::SESSION_KEY_NAME])) {
            $todoList = $_SESSION[self::SESSION_KEY_NAME];
        }
        foreach ($todoList as  $key => $todo) {
            if ($todo->text == $pTodo->text && $todo->dueDate == $pTodo->dueDate) {
                unset($todoList[$key]);
            }
        }
        $_SESSION[self::SESSION_KEY_NAME] = $todoList;
    }

    // ======================================================================
    // TODO一覧を取得します
    // ======================================================================
    public static function getToDoList()
    {
        if (isset($_SESSION[self::SESSION_KEY_NAME])) {
            return $_SESSION[self::SESSION_KEY_NAME];
        } else {
            return array();
        }
    }
}
