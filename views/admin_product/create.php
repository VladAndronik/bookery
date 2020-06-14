<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Адмінпанель</a></li>
                    <li><a href="/admin/product">Управління товарами</a></li>
                    <li class="active">Додати книгу</li>
                </ol>
            </div>


            <h4>Додати нову книгу</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form id="productform" action="#" method="post" enctype="multipart/form-data">

                        <p>Назва книги</p>
                        <input type="text" name="name" placeholder="" value="">
                        <br/><br/>
                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="">
                        <br/><br/>
                        <p>Вартість, грн</p>
                        <input type="text" name="price" placeholder="" value="">
                        <br/><br/>
                        <p>Жанр</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['main_category'].'/'.$category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Автор</p>
                        <input type="text" name="author" placeholder="" value="">
                        <br/><br/>
                        <p>Фото книги</p>
                        <input type="file" name="image" placeholder="" value="">
					
                        <br/><br/>

                        <p>Наявність на складі</p>
                        <select name="availability">
                            <option value="1" selected="selected">Так</option>
                            <option value="0">Ні</option>
                        </select>

                        <br/><br/>

                     


                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Відображається</option>
                            <option value="0">Приховано</option>
                        </select>

                        <br/><br/>

						   <p>Опис книги</p>
                        <textarea name="description" style="height: 120px;"></textarea>
						<br/><br/>
						
						
						<br/><br/>
                        <input type="submit" name="submit" class="btn btn-default" value="Зберегти">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>