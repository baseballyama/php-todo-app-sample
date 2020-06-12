<?php

// =====================================================================
// 本アプリケーションのメインページです.
// ======================================================================

// 必要なファイルを読み込みます
require('ToDoListController.php');
require('ToDo.php');
require('Utils.php');

// セッションを開始します.
session_start();

// ======================================================================
// TODO一覧をHTML形式で出力します.
// ======================================================================
function printTodoList()
{
    foreach (ToDoListController::getToDoList() as &$todo) {
        echo <<<EOM
            <form action="index.php" method="post" class="todo-viewer">
                <input type="submit" value="完了" />
                <input type="hidden" name="action" value="remove" />
                <section>
                    <input type="text" name="text" value="$todo->text" readonly />
                </section>
                <section>
                    <input type="text" name="dueDate" value="$todo->dueDate" readonly />
                </section>
            </form>
        EOM;
    }
}

// ======================================================================
// POST通信のイベントをハンドルする処理です.
// ======================================================================
function hundleEvent()
{
    if (!isset($_POST['action'])) {
        return;
    }

    if ($_POST['action'] == 'register') {
        return registerTodo();
    } else if ($_POST['action'] == 'remove') {
        return removeTodo();
    } else {
        return '想定外のイベントです。';
    }
}

// ======================================================================
// TODOを登録します.
// ======================================================================
function registerTodo()
{
    if (isset($_POST['text'])) {
        $todo = new ToDo();
        $todo->text = $_POST['text'];
        $todo->dueDate = $_POST['dueDate'];
        ToDoListController::addToDo($todo);
    }
    return 'TODOを登録しました!';
}

// ======================================================================
// TODOを削除します.
// ======================================================================
function removeTodo()
{
    if (isset($_POST['text'])) {
        $todo = new ToDo();
        $todo->text = $_POST['text'];
        $todo->dueDate = $_POST['dueDate'];
        ToDoListController::removeToDo($todo);
    }
    return 'TODOを完了しました!';
}
?>

<html>

<head>
    <link href="./styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <title>PHP Test</title>
</head>

<body>
    <div class="wrapper">
        <header></header>
        <main class="content">
            <div class="title">
                <p>PHPで作る初めてのTODO管理アプリ</p>
            </div>
            <?php
            echo '<div class="action-result">' . hundleEvent() . '</div>';
            ?>
            <form action="registration.php" method="GET">
                <input type="submit" value="TODO追加" />
            </form>
            <?php
            printTodoList();
            ?>
        </main>
        <footer>
            <p>(c) Yuichiro Yamashita</p>
            <p style="font-size: 0.8rem">注意 : 本アプリケーションはJavaエンジニアが何もわからないPHPでTODOアプリを作ったらどうなるのかを検証するために作成したアプリです。</p>
            <p style="font-size: 0.8rem">PHPのアンチパターンやセキュリティの問題、またPOSTの重複送信などの問題を抱えていますが企画としては完了したのでこの状態で放置します。</p>
            <p style="font-size: 0.8rem">皆様におかれては本企画を実施した以下のYouTubeを参照頂きお楽しみ頂ければと思います。</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/LzW_xZft3TQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </footer>
    </div>
</body>

</html>