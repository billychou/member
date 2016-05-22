<?php
// This file contains functions used by the admin interface
// for the Book-O-Rama shopping cart.
header('Content-Type:text/html;charset=utf-8');

function display_category_form($category = '') {
// This displays the category form.
// This form can be used for inserting or editing categories.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_category.php.
// To update, pass an array containing a category.  The
// form will contain the old data and point to update_category.php.
// It will also add a "Delete category" button.

  // if passed an existing category, proceed in "edit mode"
  $edit = is_array($category);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
      action="<?php echo $edit ? 'edit_category.php' : 'insert_category.php'; ?>">
  <table border="0">
  <tr>
    <td>Category Name:</td>
    <td><input type="text" name="catname" size="40" maxlength="40"
          value="<?php echo $edit ? $category['catname'] : ''; ?>" /></td>
   </tr>
  <tr>
    <td <?php if (!$edit) { echo "colspan=2";} ?> align="center">
      <?php
         if ($edit) {
            echo "<input type=\"hidden\" name=\"catid\" value=\"".$category['catid']."\" />";
         }
      ?>
      <input type="submit"
       value="<?php echo $edit ? 'Update' : 'Add'; ?> Category" /></form>
     </td>
     <?php
        if ($edit) {
          //allow deletion of existing categories
          echo "<td>
                <form method=\"post\" action=\"delete_category.php\">
                <input type=\"hidden\" name=\"catid\" value=\"".$category['catid']."\" />
                <input type=\"submit\" value=\"Delete category\" />
                </form></td>";
       }
     ?>
  </tr>
  </table>
<?php
}

function display_book_form($book = '') {
// This displays the book form.
// It is very similar to the category form.
// This form can be used for inserting or editing books.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_book.php.
// To update, pass an array containing a book.  The
// form will be displayed with the old data and point to update_book.php.
// It will also add a "Delete book" button.


  // if passed an existing book, proceed in "edit mode"
  $edit = is_array($book);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
        action="<?php echo $edit ? 'edit_book.php' : 'insert_book.php';?>">
  <table border="0">
  <tr>
    <td>ISBN:</td>
    <td><input type="text" name="isbn"
         value="<?php echo $edit ? $book['isbn'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Book Title:</td>
    <td><input type="text" name="title"
         value="<?php echo $edit ? $book['title'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Book Author:</td>
    <td><input type="text" name="author"
         value="<?php echo $edit ? $book['author'] : ''; ?>" /></td>
   </tr>
   <tr>
      <td>Category:</td>
      <td><select name="catid">
      <?php
          // list of possible categories comes from database
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat) {
               echo "<option value=\"".$thiscat['catid']."\"";
               // if existing book, put in current catgory
               if (($edit) && ($thiscat['catid'] == $book['catid'])) {
                   echo " selected";
               }
               echo ">".$thiscat['catname']."</option>";
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo $edit ? $book['price'] : ''; ?>" /></td>
   </tr>
   <tr>
     <td>Description:</td>
     <td><textarea rows="3" cols="50"
          name="description"><?php echo $edit ? $book['description'] : ''; ?></textarea></td>
    </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old isbn to find book in database
             // if the isbn is being updated
             echo "<input type=\"hidden\" name=\"oldisbn\"
                    value=\"".$book['isbn']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Book" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_book.php\">
                   <input type=\"hidden\" name=\"isbn\"
                    value=\"".$book['isbn']."\" />
                   <input type=\"submit\" value=\"Delete book\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}

function display_password_form() {
// displays html change password form
?>
   <div align="center">
   <br />
   <form action="change_password.php" name="change_ps" method="post" onsubmit="return check();">
   <table width="250" cellpadding="2" cellspacing="0">
   <tr><td>旧密码:</td>
       <td><input type="password" id="o_ps" name="old_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>新密码:</td>
       <td><input type="password" id="n_ps" name="new_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>重复新密码:</td>
       <td><input type="password" id="n2_ps" name="new_passwd2" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="确认更改密码">
   </td></tr>
   </table>
   <br />
   </div>
<?php
}

function insert_category($catname) {
// inserts a new category into the database

   $conn = db_connect();

   // check category does not already exist
   $query = "select *
             from categories
             where catname='".$catname."'";
   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     echo '"$result->num_rows"';	   
     echo 'Error:Can not query.';
     return false;
   }

   // insert new category
   $query = "insert into categories values
            (null,'".$catname."')";
   $result = $conn->query($query);
   if (!$result) {
           echo $conn->affected_rows." insert into categories";
           echo '</br>';
           echo 'Error:can not insert query.';
     return false;
   } else {
     return true;
   }
}

function insert_book($isbn, $title, $author, $catid, $price, $description) {
// insert a new book into the database

   $conn = db_connect();

   // check book does not already exist
   $query = "select *
             from books
             where isbn='".$isbn."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new book
   $query = "insert into books values
            ('".$isbn."', '".$author."', '".$title."',
             '".$catid."', '".$price."', '".$description."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_card($card_num
                     ,$customer_name
                     ,$product_name
                     ,$product_spc
                     ,$buying_unit
                     ,$buying_quantity
                     ,$buying_price
                     ,$operator
                     ,$note)
{
   // insert a new card into the database

   $conn = db_connect();
   //echo "card_num:".$card_num;
   // check card does not already exist
   $query = "select *
             from card
             where cardindex='".$card_num."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     echo $card_num."has existed!";
     return false;
   }

   // insert new card
   $query = "insert into card values
           (NULL
           ,'".$card_num."'
           , '".$customer_name."'
           , '".$product_name."'
           , '".$product_spc."'
           , '".$buying_unit."'
           , '".$buying_quantity."'
           , '".$buying_price."'
           , '".$operator."'
           , '".$note."')";
   
   /*
   echo $card_num;
   echo $customer_name;
   echo $product_name;
   echo $product_spc;
   echo $buying_unit;
   echo $buying_quantity;
   echo $buying_price;
   echo $operator;
   echo $note;
   */

   $result = $conn->query($query);
   if (!$result) {
     echo $card_num."failed to insert!";
     return false;
   } else {
     return true;
   }

}

function insert_rechargecard($card_num
                             ,$billnum
                             ,$customer_name
                             ,$product_name
                             ,$product_spc
                             ,$buying_unit
                             ,$buying_quantity
                             ,$buying_price
                             ,$cost
                             ,$time
                             ,$operator
                             ,$note)
{
     // insert a new card into the database

   $conn = db_connect();
   //echo "card_num:".$card_num;
   // check card does not already exist
   $query = "select * from rechargecard
             where cardindex='".$card_num."'
             and customername = '".$customer_name."'
             and importbillindex='".$billnum."'
             and concretename='".$product_name."'
             and concretespc='".$product_spc."'
             and concreteunit='".$buying_unit."'
             and quantity='".$buying_quantity."'
             and concreteprice='".$buying_price."'
             and cost='".$cost."'
             and date='".$time."'
             and operator='".$operator."'";
   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     echo $card_num."has existed!";
     return false;
   }
   /*
   echo $card_num;
   echo $customer_name;
   echo $billnum;
   echo $product_name;
   echo $product_spc;
   echo $buying_unit;
   echo $buying_quantity;
   echo $buying_price;
   echo $cost;
   echo $time;
   echo $operator;
   echo $note;
    */
   // insert new card
   $query = "insert into rechargecard values
           (NULL
            ,'".$card_num."'
            ,'".$customer_name."'
            ,'".$billnum."'
            ,'".$product_name."'
            ,'".$product_spc."'
            ,'".$buying_unit."'
            ,'".$buying_quantity."'
            ,'".$buying_price."'
            ,'".$cost."'
            ,'".$time."'
            ,'".$operator."'
            ,'".$note."')";

   $result = $conn->query($query);
   if (!$result) {
     echo $card_num."failed to insert!";
     return false;
   } else {
     return true;
   }

}

function insert_billoflading($billindex,
                             $cardid,
                             $importlistid,
                             $customerid,
                             $driverid,
                             $updatetime,
                             $purunitid ,
                             $whereisfrom,
                             $traunitid,
                             $wheretogo,
                             $concreteprice,
                             $shipprice,
                             $driverprice,
                             $takeamount,
                             $realamount,
                             $receiveamount,
                             $payment,
                             $operator,
                             $dept,
                             $note
                        )
{
   $conn = db_connect();
   $query = "select * from billoflading
           where billindex ='".$billindex."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     //echo $cardindex."has existed!";
     return false;
   }
   //echo $date;
   // insert new card
   $query = "insert into billoflading values
             (NULL,
             '".$billindex."',
                             '".$cardid."',
                             '".$importlistid."',
                             '".$customerid."',
                             '".$driverid."',
                             '".$updatetime."',
                             '".$purunitid."' ,
                             '".$whereisfrom."',
                             '".$traunitid."',
                             '".$wheretogo."',
                             '".$concreteprice.",
                             '".$shipprice."',
                             '".$driverprice."',
                             '".$takeamount."',
                             '".$realamount."',
                             '".$receiveamount."',
                             '".$payment."',
                             '".$operator."',
                             '".$dept."',
                             '".$note."')";

   $result = $conn->query($query);
   if (!$result) { 
     return false;
   } else {
     return true;
   }
}

function update_billoflading_by_id($id,
                             $billindex,
                             $cardid,
                             $importlistid,
                             $customerid,
                             $driverid,
                             $updatetime,
                             $purunitid ,
                             $whereisfrom,
                             $traunitid,
                             $wheretogo,
                             $concreteprice,
                             $shipprice,
                             $driverprice,
                             $takeamount,
                             $realamount,
                             $receiveamount,
                             $payment,
                             $operator,
                             $dept,
                             $note
                     )
{
        $conn = db_connect();
        $query = "update billoflading
                  set billindex = '".$billindex."',
                      cardid=       '".$cardid."',
                      importlistid=       '".$importlistid."',
                      customerid=       '".$customerid."',
                      driverid=       '".$driverid."',
                      updatetime=       '".$updatetime."',
                      purunitid=       '".$purunitid."' ,
                      whereisfrom=       '".$whereisfrom."',
                      traunitid=       '".$traunitid."',
                      wheretogo=       '".$wheretogo."',
                      concreteprice=       '".$concreteprice.",
                      shipprice=       '".$shipprice."',
                      driverprice=       '".$driverprice."',
                      takeamount=       '".$takeamount."',
                      realamount=       '".$realamount."',
                      receiveamount=       '".$receiveamount."',
                      payment=       '".$payment."',
                      operator=       '".$operator."',
                      department=       '".$dept."',
                      note=       '".$note."')";  
      $result = @$conn->query($query);
      if (!$result) {
        return false;
      } else {
        return true;
      }   
}

function insert_concrete($spc
                         ,$unit
                         ,$note
                         ,$updatetime
                         ,$factoryid)
{
   // insert a new concrete into the database

   $conn = db_connect();

   // check concrete does not already exist
   $query = "select *
             from concrete
			 where spc='".$spc."' 
                         and unit='".$unit."'
                         and factoryid = '".$factoryid."'";

   $result = $conn->query($query);
   
   
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new card
   $query = "insert into concrete values
           (NULL
           ,'".$spc."'
           ,'".$unit."'
           ,'".$note."'
           ,'".$updatetime."'
           ,'".$factoryid."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }                              
}

function insert_traunit($name
                       ,$note
                       ,$dept
                       ,$updatetime)
{
   // insert a new concrete into the database
   //echo $name;
   //echo $note;
   //echo $dept;

   $conn = db_connect();

   // check concrete does not already exist
   $query = "select *
             from traunit
             where name ='".$name."'
             and note ='".$note."'
             and department ='".$dept."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     //echo "<br/>";
     //echo "查询数据库失败，请稍后再试!";
     //echo "<br/>";
     //echo $dept;
     return false;
   }

   // insert new card
   $query = "insert into traunit values
           (NULL
           ,'".$name."'
           ,'".$note."'
           ,'".$updatetime."'
           ,'".$dept."')";

   $result = $conn->query($query);
   if (!$result) {
     //echo "<br/>";
     //echo "插入数据库失败，请稍后再试!";
     //echo "<br/>";
     //echo $dept;
     return false;
   } else {
     return true;
   }                              
}

function insert_purunit($name
                       ,$note
                       ,$dept
                       ,$updatetime)
{
   // insert a new concrete into the database
   //echo "name:".$name."<br/>";
        //echo "note:".$note."<br/>";
   $conn = db_connect();   
   // check concrete does not already exist
   $query = "select *
             from purunit
             where name ='".$name."'
             and note ='".$note."'
             and department ='".$dept."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new card
   $query = "insert into purunit values
           (NULL
           ,'".$name."'
           ,'".$note."'
           ,'".$updatetime."'
           ,'".$dept."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }                              
}

function insert_company($name
                       ,$note
                       ,$dept
                       ,$updatetime)
{
   // insert a new concrete into the database
   //echo "name:".$name."<br/>";
        //echo "note:".$note."<br/>";
   $conn = db_connect();   
   // check concrete does not already exist
   $query = "select *
             from company
             where name ='".$name."'
             and note ='".$note."'
             and department ='".$dept."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new card
   $query = "insert into company values
           (NULL
           ,'".$name."'
           ,'".$note."'
           ,'".$updatetime."'
           ,'".$dept."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }                              
}

function insert_factory($name
                       ,$note
                       ,$updatetime)
{
   // insert a new concrete into the database
   //echo "name:".$name."<br/>";
        //echo "note:".$note."<br/>";
   $conn = db_connect();   
   // check concrete does not already exist
   $query = "select *
             from factory
             where name ='".$name."'
             and note ='".$note."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new card
   $query = "insert into factory values
           (NULL
           ,'".$name."'
           ,'".$note."'
           ,'".$updatetime."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }                              
}

function insert_importlist($listindex,$purunitid ,$concreteid,$initvalue,$purchaseprice,$unit,$updatetime,$dept,$note)
{
// insert a new bill into the database

   $conn = db_connect();

   // check concrete does not already exist
   $query = "select *
             from importlist
             where listindex='".$listindex."'
             and purunitid ='".$purunitid."'
             and concreteid='".$concreteid."'
             and initvalue ='".$initvalue."'
             and purchaseprice ='".$purchaseprice."'
             and unit ='".$unit."'
             and updatetime='".$updatetime."'
             and department='".$dept."'
             and note='".$note."'";

   $result = $conn->query($query);

   if (!$result) {
     echo "can not query!";
     return false;
   }
   if($result->num_rows!=0) {
           echo "data has existed!";
           return false;
   }

   // insert new importbill
   /*
   echo "$num";
   echo "<br/>";
   echo "$purunit";
   echo "<br/>";
   echo "$time";
   echo "<br/>";
   echo "$name";
   echo "<br/>";
   echo "$spc";
   echo "<br/>";
   echo "$unit";
   echo "<br/>";
   echo "$quantity";
   echo "<br/>";
   echo "$price";
   echo "<br/>";
   echo "$cost";
   echo "<br/>";
   echo "$note";
   */
   $query = "insert into importlist values
           (NULL
            ,'".$listindex."'
            ,'".$purunitid."'
            ,'".$concreteid."'
            ,'".$initvalue."'
            ,'".$initvalue."'
            ,'".$initvalue."'
            ,'".$purchaseprice."'
            ,'".$unit."'
            ,'".$updatetime."'
            ,'".$dept."'
            ,'".$note."')";

   $result = $conn->query($query);
   if (!$result) {
     echo "failed to insert!";
     return false;
   } else {
     return true;
   }                         
}

function insert_mergelist($listindex,$importlistid1,$importlistid2,$factoryvalue1,$factoryvalue2,$updatetime,$dept,$note)
{
      // insert a new bill into the database

   $conn = db_connect();

   // check concrete does not already exist
   $query = "select *
             from mergelist
             where listindex='".$listindex."'
             and importlistid1 ='".$importlistid1."'
             and importlistid2='".$importlistid2."'
             and factoryvalue1 ='".$factoryvalue1."'
             and factoryvalue2 ='".$factoryvalue2."'
             and updatetime='".$updatetime."'
             and department='".$dept."'
             and note='".$note."'";

   $result = $conn->query($query);

   if (!$result) {
     //echo "can not query!";
     return false;
   }
   if($result->num_rows!=0) {
           //echo "data has existed!";
           return false;
   }

   // insert new importbill
   /*
   echo "$num";
   echo "<br/>";
   echo "$purunit";
   echo "<br/>";
   echo "$time";
   echo "<br/>";
   echo "$name";
   echo "<br/>";
   echo "$spc";
   echo "<br/>";
   echo "$unit";
   echo "<br/>";
   echo "$quantity";
   echo "<br/>";
   echo "$price";
   echo "<br/>";
   echo "$cost";
   echo "<br/>";
   echo "$note";
   */
   $query = "insert into mergelist values
           (NULL
            ,'".$listindex."'
            ,'".$importlistid1."'
            ,'".$importlistid2."'
            ,'".$factoryvalue1."'
            ,'".$factoryvalue2."'
            ,'".$updatetime."'
            ,'".$dept."'
            ,'".$note."')";

   $result = $conn->query($query);
   if (!$result) {
     //echo "failed to insert!";
     return false;
   } else {
     return true;
   }                           
}


function update_importlist_by_id($id,$listindex,$purunitid ,$concreteid,$initvalue,$purchaseprice,$unit,$updatetime,$dept,$note)
{
// insert a new bill into the database

   $conn = db_connect();

   // check concrete does not already exist
   $query = "update importlist
             set listindex='".$listindex."'
             ,purunitid ='".$purunitid."'
             ,concreteid='".$concreteid."'
             ,initvalue ='".$initvalue."'
             ,rechargevalue='".$initvalue."'
             ,factoryvalue='".$initvalue."'
             ,purchaseprice ='".$purchaseprice."'
             ,unit ='".$unit."'
             ,updatetime='".$updatetime."'
             ,department='".$dept."'
             ,note='".$note."'
             where id = '".$id."'";
   $result = $conn->query($query);
   if (!$result) {
     echo "failed to insert!";
     return false;
   } else {
     return true;
   }                         
}

function insert_merged_bill($num
                     ,$purunit
                     ,$time
                     ,$name
                     ,$spc
                     ,$unit
                     ,$quantity
                     ,$price
                     ,$cost
                     ,$note)        

{
// insert a new bill into the database

   $conn = db_connect();

   // check concrete does not already exist
   $query = "select *
             from importbill
             where billindex='".$num."'
             and purunit ='".$purunit."'
             and date='".$time."'
             and concretename ='".$name."'
             and concretespc ='".$spc."'
             and concreteunit ='".$unit."'
             and origonamount='".$quantity."'
             and importprice='".$price."'
             and cost='".$cost."'";

   $result = $conn->query($query);

   if (!$result) {
     echo "can not query!";
     return false;
   }
   if($result->num_rows!=0) {
           echo "data has existed!";
           return false;
   }

   // insert new importbill
   /*
   echo "$num";
   echo "<br/>";
   echo "$purunit";
   echo "<br/>";
   echo "$time";
   echo "<br/>";
   echo "$name";
   echo "<br/>";
   echo "$spc";
   echo "<br/>";
   echo "$unit";
   echo "<br/>";
   echo "$quantity";
   echo "<br/>";
   echo "$price";
   echo "<br/>";
   echo "$cost";
   echo "<br/>";
   echo "$note";
    */
   $amount = 0;
   $query = "insert into importbill values
           ('".$num."'
            ,'".$purunit."'
            ,'".$time."'
            ,'".$name."'
            ,'".$spc."'
            ,'".$unit."'
            ,'".$quantity."'
            ,'".$amount."'
            ,'".$quantity."'
            ,'".$price."'
            ,'".$cost."'
            ,'".$note."')";

   $result = $conn->query($query);
   if (!$result) {
     echo "failed to insert!";
     return false;
   } else {
     return true;
   }                         
}

function insert_customer(//$index,
                          $name
                         ,$address
                         ,$phone
                         ,$note
                         ,$dept
                         ,$updatetime)
{
   // insert a new customer into the database

   $conn = db_connect();
   //mysqli_query('SET NAMES UTF8'); 
   // check concrete does not already exist
   $query = "select *
             from customer
             where name ='".$name."'
             and address ='".$address."'
             and phoneNum ='".$phone."'
             and department ='".$dept."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new customer
   $query = "insert into customer values
           (NULL
           , '".$name."'
           , '".$address."'
           , '".$phone."'
           , '".$note."'
           , '".$dept."'
           , '".$updatetime."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }                              
}

function insert_driver($name,$frontNum,$phoneNum,$backNum,$carSize,$dept,$updatetime)
{
          // insert a new driver into the database

   $conn = db_connect();

   // check concrete does not already exist
   $query = "select *
             from driver
             where name ='".$name."'
             and phoneNum ='".$phoneNum."'
             and frontNum ='".$frontNum."'
             and backNum ='".$backNum."'
             and carSize = '".$carSize."'
             and department = '".$dept."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     //echo "查询数据库失败!";
     return false;
   }

   // insert new customer
   $query = "insert into driver values
           (NULL
           , '".$name."'
           , '".$frontNum."'
           , '".$backNum."'
           , '".$carSize."'
           , '".$phoneNum."'
           , '".$dept."'
           , '".$updatetime."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }    
}

function update_category($catid, $catname) {
// change the name of category with catid in the database

   $conn = db_connect();

   $query = "update categories
             set catname='".$catname."'
             where catid='".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_card_amount($cardnum, $curamount) {
// change the amount of card with cardnum in the database

   //echo $cardnum;
   //echo $curamount;
   $conn = db_connect();
   $query = "update card
             set curconcreteamount='".$curamount."'
             where cardindex='".$cardnum."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "卡".$cardnum."failed to update concreteamount";
     return false;
   } else {
     return true;
   }
}


function update_customer($customer_name,$customer_phone,$address,$note,$dept)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update customer
             set phoneNum ='".$customer_phone."'
             ,address = '".$address."'
             ,note ='".$note."'
             ,department ='".$dept."'
             where name ='".$customer_name."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_customer_by_id($customer_id,$customer_name,$customer_phone,$address,$note,$dept,$updatetime)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update customer
            set name ='".$customer_name."'
             ,phoneNum ='".$customer_phone."'
             ,address = '".$address."'
             ,note ='".$note."'
             ,department ='".$dept."'
             ,updatetime ='".$updatetime."'
             where customerid ='".$customer_id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_customer($customer_name)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from customer
             where name='".$customer_name."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除客户数据失败!";
     return false;
   } else {
     return true;
   }
}

function delete_customer_by_id($customer_id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from customer
             where customerid='".$customer_id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除客户数据失败!";
     return false;
   } else {
     return true;
   }
}


function update_concrete_by_id($concreteid,$spc,$unit,$note,$updatetime,$factoryid)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update concrete
           set spc = '".$spc."'
             ,note ='".$note."'
             ,unit='".$unit."'
             ,updatetime ='".$updatetime."'
             ,factoryid = '".$factoryid."'
             where concreteid = '".$concreteid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_concrete_by_id($id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from concrete
             where concreteid='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除水泥数据失败!";
     return false;
   } else {
     return true;
   }
}

function update_purunit_by_id($id,$name,$note,$dept,$updatetime)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update purunit
           set name ='".$name."' 
             ,note ='".$note."'
             ,updatetime ='".$updatetime."'
             ,department='".$dept."'
             where id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_company_by_id($id,$name,$note,$dept,$updatetime)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update company
           set name ='".$name."' 
             ,note ='".$note."'
             ,updatetime ='".$updatetime."'
             ,department='".$dept."'
             where id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function delete_purunit_by_id($id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from purunit
             where id='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除购货单位数据失败!";
     return false;
   } else {
     return true;
   }
}

function delete_factory_by_id($id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from factory
             where id='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除厂家信息数据失败!";
     return false;
   } else {
     return true;
   }
}

function delete_company_by_id($id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from company
             where id='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除公司数据失败!";
     return false;
   } else {
     return true;
   }
}

function update_traunit_by_id($id,$name,$note,$dept,$updatetime)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update traunit
           set name ='".$name."' 
             ,note ='".$note."'
             ,updatetime ='".$updatetime."'
             ,department='".$dept."'
             where id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_factory_by_id($id,$name,$note,$updatetime)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update factory
           set name ='".$name."' 
             ,note ='".$note."'
             ,updatetime ='".$updatetime."'
             where id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_traunit_by_id($id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from traunit
             where id='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除运输单位数据失败!";
     return false;
   } else {
     return true;
   }
}


function update_driver($driver_name,$driver_phone,$carNum,$carSize,$dept)
{
   // change the amount of card with bill in the database
        /*
        echo "update driver";
         echo "<br/>";
   echo $carNum;
   echo "<br/>";
   echo $carSize;
    echo "<br/>";
   echo $driver_name;
    echo "<br/>";
   echo $dept;
    echo "<br/>";
   echo $driver_phone;
   echo "<br/>";
         */
   $conn = db_connect();

   $query = "update driver
             set carNum = '".$carNum."'
             ,carSize ='".$carSize."'
             ,phoneNum ='".$driver_phone."'
             ,department ='".$dept."'
             where name ='".$driver_name."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "更新司机信息失败!";
     return false;
   } else {
     return true;
   }
}

function update_driver_by_id($id,$name,$phoneNum,$frontNum,$backNum,$carSize,$dept,$updatetime)
{
   // change the amount of card with bill in the database
        /*
        echo "update driver";
         echo "<br/>";
   echo $carNum;
   echo "<br/>";
   echo $carSize;
    echo "<br/>";
   echo $driver_name;
    echo "<br/>";
   echo $dept;
    echo "<br/>";
   echo $driver_phone;
   echo "<br/>";
         */
   $conn = db_connect();

   $query = "update driver
             set name ='".$name."'
             ,phoneNum = '".$phoneNum."'
             ,frontNum = '".$frontNum."'
             ,backNum = '".$backNum."'
             ,carSize ='".$carSize."'
             ,department ='".$dept."'
             where driverId = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "更新司机信息失败!";
     return false;
   } else {
     return true;
   }
}

function delete_driver($driver_name)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from driver
             where name='".$driver_name."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除客户数据失败!";
     return false;
   } else {
     return true;
   }
}

function delete_driver_by_id($driver_id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from driver
             where driverId='".$driver_id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除客户数据失败!";
     return false;
   } else {
     return true;
   }
}

function update_bill_amount($billnum,$curamount)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update importbill
             set amount='".$curamount."'
             where billindex='".$billnum."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_bill_amount_to_factory($billindex,$billcur)
{
        //echo "billindex:".$billindex;
        //echo "billcur:".$billcur;
        $conn = db_connect();
        $query = "update importbill
                  set amounttofactory='".$billcur."'
                  where billindex='".$billindex."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "<br/>"."can not update billamounttofactory";
     return false;
   } else {
     return true;
   }

}

function update_factoryvalue_of_importlist($importlistid,$newvalue)
{
        //echo "billindex:".$billindex;
        //echo "billcur:".$billcur;
        $conn = db_connect();
        $query = "update importlist
                  set factoryvalue='".$newvalue."'
                  where id='".$importlistid."'";
   $result = @$conn->query($query);
   if (!$result) {
     //echo "<br/>"."can not update billamounttofactory";
     return false;
   } else {
     return true;
   }

}

function update_import_bill($num
                     ,$purunit
                     ,$time
                     ,$name
                     ,$spc
                     ,$unit
                     ,$quantity
                     ,$price
                     ,$cost
                     ,$amount
                     ,$amounttofactory
                     ,$note)
{
        /*
        echo "num:".$num;
        echo "<br/>";
        echo "purunit:".$purunit;
        echo "<br/>"; 
        echo "time:".$time;
        echo "<br/>";
        echo "name:".$name;
        echo "<br/>";
        echo "spc:".$spc;
        echo "<br/>";
        echo "unit:".$unit;
        echo "<br/>";
        echo "quantity:".$quantity;
        echo "<br/>";
        echo "price:".$price;
        echo "<br/>";
        echo "cost:".$cost;
        echo "<br/>";
        echo "amount".$amount;
        echo "<br/>";
        echo "amoutotfa:".$amounttofactory;
        echo "<br/>";
        echo "note:".$note;
        */
        $conn = db_connect();
        $query = "update importbill
                set purunit = '".$purunit."'
                 ,date ='".$time."'
                 ,concretename ='".$name."'
                 ,concretespc ='".$spc."'
                 ,concreteunit ='".$unit."'
                 ,origonamount ='".$quantity."'
                 ,importprice ='".$price."'
                 ,amount='".$amount."'
                 ,amounttofactory='".$amounttofactory."'
                 ,cost='".$cost."'
                 ,note ='".$note."'
                  where billindex='".$num."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "<br/>"."can not update billamounttofactory";
     return false;
   } else {
     return true;
   }

}



function delete_import_bill($index)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from importbill
             where billindex='".$index."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除进货数据失败!";
     return false;
   } else {
     return true;
   }
}

function delete_importlist_by_id($id)
{
   // change the amount of card with bill in the database
   //echo $customer_name."测试";
   $conn = db_connect();
   /*
   $query = "select * from customer where name='".$customer_name."'";
   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
           echo "<br/>";
           echo "数据库中没有此客户信息!";
           return false;
   }
   */
   $query = "delete from importlist
             where id='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "删除进货数据失败!";
     return false;
   } else {
     return true;
   }
}

function update_billway_amount($billwayindex,$curbillamount,$curcardamount,$realamount,$receiveamount)
{
   // change the amount of card with bill in the database

   $conn = db_connect();

   $query = "update billway
             set billcur='".$curbillamount."'
             where billwayindex='".$billwayindex."'";
   $result = @$conn->query($query);
   if (!$result) {
           return false;
   }
   $query = "update billway
             set cardcur='".$curcardamount."'
             where billwayindex='".$billwayindex."'";
   $result = @$conn->query($query);
   if (!$result) {
           return false;
   }
   $query = "update billway
             set realamount='".$realamount."'
             where billwayindex='".$billwayindex."'";
   $result = @$conn->query($query);
   if (!$result) {
           return false;
   }

   $query = "update billway
             set receiveamount='".$receiveamount."'
             where billwayindex='".$billwayindex."'";
   $result = @$conn->query($query);
   if (!$result) {
           return false;
   }
   return true;
}

function update_billway_realcost($billwayindex,$cost,$realcost,$debt)
{
        /*
        echo "billwayindex:".$billwayindex;
        echo "<br/>";
        echo "cost:".$cost;
        echo "<br/>";
        echo "realcost:".$realcost;
        echo "<br/>";
        echo "debt:".$debt;
        echo "<br/>";
         */
        $currealcost = (float)$cost - (float)$debt; 
        //echo "currealcost:".$currealcost;
        //echo "<br/>";
        if($currealcost < 0 ){
                echo "<div align=\"center\">$billwayindex 欠账金额 $debt 不能大于应付金额 $cost!</div>";
                return false;
        }
        $conn = db_connect();
        $query = "update billway
                  set realcost='".$currealcost."'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更新实收金额数值!";
                echo "<br/>";
                return false;
        }
        return true;
}

function reset_billway_cost_realcost_note($billwayindex)
{
        /*
        echo "billwayindex:".$billwayindex;
        echo "<br/>";
        echo "cost:".$cost;
        echo "<br/>";
        echo "realcost:".$realcost;
        echo "<br/>";
        echo "debt:".$debt;
        echo "<br/>";
         */
        $conn = db_connect();
        $query = "update billway
                  set realcost='0'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更新实收金额数值!";
                echo "<br/>";
                return false;
        }

        $query = "update billway
                  set cost='0'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更应收金额数值!";
                echo "<br/>";
                return false;
        }

        //$conn = db_connect();
        $query = "update billway
                  set note ='撤销派车单'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更新备注信息!";
                echo "<br/>";
                return false;
        }

        return true;
}


function reset_billway_realamount_receiveamount_note($billwayindex)
{
        $conn = db_connect();
        $query = "update billway
                  set realamount='0'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更新实发数量数量!";
                echo "<br/>";
                return false;
        }

        $query = "update billway
                  set receiveamount='0'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更应收数量!";
                echo "<br/>";
                return false;
        }

        //$conn = db_connect();
        $query = "update billway
                  set note ='撤销派车单'
                  where billwayindex='".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "无法更新备注信息!";
                echo "<br/>";
                return false;
        }

        return true;
}


function update_card($card_num
                     ,$customer_name
                     ,$product_name
                     ,$product_spc
                     ,$buying_unit
                     ,$buying_quantity
                     ,$buying_price
                     ,$operator
                     ,$note)
{
        $conn = db_connect();
        $curconcreteamount = (float)get_card_concreteamount($card_num) + (float)$buying_quantity;
        $query = "update card
                  set customername ='".$customer_name."' 
                  ,concretename ='".$product_name."'
                  ,concretespc='".$product_spc."'
                  ,concreteunit='".$buying_unit."'
                  ,curconcreteamount='".$curconcreteamount."'
                  ,curconcreteprice='".$buying_price."' 
                  ,operator='".$operator."'
                  ,note='".$note."'
                  where cardindex='".$card_num."'";
         $result = @$conn->query($query);
         if (!$result) {
                return false;
        } else {
                return true;
        }
}

function update_book($oldisbn, $isbn, $title, $author, $catid,
                     $price, $description) {
// change details of book stored under $oldisbn in
// the database to new details in arguments

   $conn = db_connect();

   $query = "update books
             set isbn= '".$isbn."',
             title = '".$title."',
             author = '".$author."',
             catid = '".$catid."',
             price = '".$price."',
             description = '".$description."'
             where isbn = '".$oldisbn."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_category($catid) {
// Remove the category identified by catid from the db
// If there are books in the category, it will not
// be removed and the function will return false.

   $conn = db_connect();

   // check if there are any books in category
   // to avoid deletion anomalies
   $query = "select *
             from books
             where catid='".$catid."'";

   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
     return false;
   }

   $query = "delete from categories
             where catid='".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function delete_book($isbn) {
// Deletes the book identified by $isbn from the database.

   $conn = db_connect();

   $query = "delete from books
             where isbn='".$isbn."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_manager($manager_name) {
// Deletes the book identified by $isbn from the database.

   $conn = db_connect();

   $query = "delete from admin
             where username='".$manager_name."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function register($username,$password,$level) {
// register new person with db
// return true or error message

  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from admin where username='".$username."'");
  if (!$result) {
    throw new Exception('数据库查询失败!请稍后再试!');
  }

  if ($result->num_rows>0) {
     throw new Exception('该用户名已注册，请重新选择!');
  }

  if($level == "管理员"){
        $level_index = 1;
  }else if ($level == "物流操作员"){
        $level_index = 0;
  }else if ($level == "销售操作员"){
        $level_index = 2;  
  } else {
      throw new Exception('用户权限指定错误!');  
  }
  // if ok, put in db
  $result = $conn->query("insert into admin values
                         ('".$username."', sha1('".$password."'), '".$level_index."')");
  if (!$result) {
      throw new Exception('数据库写入失败，请稍后再试!');
  }

  return true;
}

function delete_all_data() {
   $conn = db_connect();
   $query = "delete from customer";
   $result = @$conn->query($query);

   $query = "delete from driver";
   $result = @$conn->query($query);

   $query = "delete from concrete";
   $result = @$conn->query($query);

   $query = "delete from card";
   $result = @$conn->query($query);
  
   $query = "delete from importbill";
   $result = @$conn->query($query);
  
   $query = "delete from rechargecard";
   $result = @$conn->query($query);

   $query = "delete from billway";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_data($item) {
   $conn = db_connect();    
   switch($item){
   case "清空所有客户信息":
        $query = "delete from customer";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
   case"清空所有司机信息":
        $query = "delete from driver";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
    case "清空所有水泥信息":
        $query = "delete from concrete";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
     case "清空所有进货信息":
        $query = "delete from importbill";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
     case "清空所有提货信息":
        $query = "delete from billway";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
     case "清空所有购货单位":
        $query = "delete from purunit";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
     case "清空所有运输单位":
        $query = "delete from traunit";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;

      case "清空所有卡片信息":
        $query = "delete from card";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
     case "清空所有充值信息":
        $query = "delete from rechargecard";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
      case "清空所有数据信息":
        $query = "delete from customer";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from driver";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from concrete";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from card";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from importbill";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from rechargecard";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from billway";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from purunit";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }

        $query = "delete from traunit";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        } else {
                return true;
        }
        break;
default:
        echo "请选择具体删除项"."<br/>";
        return false;
        break;
   }


}

function delete_billway_data() {
   $query = "delete from billway";
   $result = @$conn->query($query);
   if (!$result) {
     echo "清空提货出厂失败!请和管理员联系";
     return false;
   } else {
     return true;
   }
}

?>
