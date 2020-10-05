<?php
    //Set Up Class AutoLoading
    spl_autoload_register(function ($class) {
        include_once dirname(__FILE__) . '/includes/' . $class . '.Class.php';
    });

    //Include Head
    include_once dirname(__FILE__) . '/templates/head.php';

    //Initiate Search Class with $_GET["search"] if Set or NOt
    $search = new Search((!empty($_GET["search"])) ? $_GET["search"] : "");
?>
    <main>
        <h1>Search iTunes Music</h1>
        <section>
            <h2>Search</h2>
            <form method="GET" action="">
                <input type="search" name="search" placeholder="Enter your search terms / keywords" value="<?php echo (!empty($_GET["search"])) ? $_GET["search"] : ""; ?>" required>
            </form>
        </section>
        <section>
            <h2>Read & Listen to Search Results</h2>
        </section>
        <?php $search->RenderSearchResults(); ?>
    </main>
<?php
    //Include Footer
    include_once dirname(__FILE__) . '/templates/footer.php';
?>