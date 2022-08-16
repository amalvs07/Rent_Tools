<?php





function component($toolname,$toolprice,$toolimage,$tooldescription,$tools_id){
    $element="
    
   <div class=\"card\">
    <form action=\"rental.php\" method=\"POST\">
    <img src=\"$toolimage\">
        <div class=\"content\">
            <div class=\"row\">
                <div class=\"details\">
                    <span>$toolname</span>
                    <p>
                    $tooldescription
                    </p>
                </div>
                <div class=\"price\">&#8377;$toolprice</div>
                
            </div>
         
            <div class=\"buttons\">

                <button class=\"cart-btn\" type=\"submit\" name=\"add\">Add to Cart</button>
                <input type='hidden' name='t_id' value='$tools_id'>
               
            </div>
        </div>
    </form>

</div>
";
echo $element;
}

function cartElement($toolname,$toolprice,$toolimage,$tools_id){
    $element = "
    
    <form action=\"cartpage.php?action=remove&id=$tools_id\" method=\"POST\" class=\"cart-items\">
    <div class=\"border rounded\">
        <div class=\"row bg-white\">
            <div class=\"col-md-3 pl-0\">
                <img src=\"$toolimage\" alt=\"Image1\" class=\"img-fluid\">
            </div>
            <div class=\"col-md-6\">
                <h5 class=\"pt-2\">$toolname</h5>
                <small class=\"text-secondary\">Seller: Rentools</small>
                <h5 class=\"pt-2\">&#8377;$toolprice</h5>

                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
            </div>
            <div class=\"col-md-3 py-5\">
            
            </div>
        </div>
    </div>
</form>
    
    ";
    echo  $element;
}
function array_column($array,$column_name){

    return array_map(function($elements)
    use($column_name)
    {
        return $elements[$column_name];
    },
    $array);
}
if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["t_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cartpage.php'</script>";
            }
        }
    }
  }
  
?>
   <!-- <h6>
                <i class=\" fas fa-star\"></i>
                <i class=\" fas fa-star\"></i>
                <i class=\" fas fa-star\"></i>
                <i class=\" fas fa-star\"></i>
                <i class=\" far fa-star\"></i>
            </h6> -->