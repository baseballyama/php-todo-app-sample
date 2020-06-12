<?php

// ======================================================================
// TODO1件を登録するページです.
// ======================================================================
?>

<html>

<head>
    <link href="./styles.css" rel="stylesheet">
    <title>PHP Test</title>
</head>

<body>
    <header></header>
    <main class="content">
        <div class="title">
            <p>PHPで作る初めてのTODO管理アプリ</p>
        </div>
        <form action="index.php" method="post" class="form">
            <section>
                <span>TODO :</span>
                <input type="text" placeholder="例 : 洗濯物を干す" name="text" required autoforcus />
                <div class="error">
                    <span class="invalid">* TODOを入力して下さい。</span>
                </div>
            </section>
            <section>
                <span>期限 :</span>
                <input type="date" name="dueDate" required />
                <div class="error">
                    <span class="invalid">* 期限を入力して下さい。</span>
                </div>
            </section>
            <section>
                <input type="hidden" name="action" value="register" />
                <input type="submit" value="登録" />
            </section>
        </form>
    </main>
</body>