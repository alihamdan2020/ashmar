<?php
// Start the session
session_start();



?>
<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
      
        <title>Admin Page</title>
        <style>
 
		   .generalDiv{
			   margin-top:20px;
			   border:0px solid green;
		   }
		   span{
			   color:red;
			   font-size:1em;
			   display:inline-block;
			   margin-left:20px;
			   width:100px;;
			   margin-right:5px;
		   }
		   .txt{
		       width:100px;
		       margin:0px 5px;
		   }
		   .txtprice{
		       width:85px;
		       margin:0px 5px;
		   }
		   .formItem{
			   margin-top:8px;
		   }

		   .allItems{
		       display:flex;
		       flex-wrap:wrap;
		   }
		   .btnUpdate{
		       margin-top:10px;
		       display:block;
		       background-color:red;
		       color:white;
		       outline:0px;
		       padding:5px 10px;
		       border:0px;
		       cursor:pointer;
		   }
		   .labels{
		       width:50px;
		       display:inline-block;
		   }
        </style>
    </head>
    <body dir="rtl">
	<div class="container">
            <h1 style="margin-top:20px">Select A CSV File that contain your items and price list</h1>
            <form action="PHP/update_insert.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFileInput" name="file">
                       
                    </div>
                    <div class="input-group-append">
                        <input type="submit" name="submit" value="upload" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <h1>
            <?php
if(isset($_SESSION['Message'])){
echo $_SESSION['Message'];
}
?>
</h1>
<h1 align="center">الصفحة الرئيسية للإعدادات</h1>
        <div class="generalDiv">
        <h1 class="heading">اختر المنتج التي تريد تعديل سعره</h1>
        <div class="allItems"></div>
        <input type="button" onclick="jm()" class="btnUpdate" value="انقر هنا للتعديل">
		</div>

<hr>
        	<div class="generalDiv">
            <h1>إضافة فئة مع الصور ة الخاصة بها</h1>
            <form action="PHP/upload.php" method="post" enctype="multipart/form-data">
			<div class='itemsForm'>
            <label class="labels">إسم الفئة</label><input type="text" name="catName[]" class='newCatName'/><input type="file" class="newCatImage" id="customFileInput" name="file[]"/>
			</div>
						
                       
                        <input type="submit" name="submit" value="upload" class="btn btn-primary" style="margin:10px 0px">
            </form>
			<button class="addNewRow">إضافة سطر جديد</button>
        </div>

       
<script>
window.addEventListener('unload', function() {
   window.opener.location.reload();
}, false);

    async function loadData(){
    //....json() mean convert answer of fetch to JSON    
    const itemsResponse=await fetch("PHP/getItems.php");
    const items=await itemsResponse.json();
    addItems(items);
//can not use items and itemsREsponse out of async function
}

loadData();

var cat=document.getElementsByClassName("allItems");
function addItems(data){
for(i=0;i<data.length;i++)
{
cat[0].appendChild(fillItemCard(data[i]));
}
}


function jm(){
	let allItems=document.querySelectorAll('.formItem');
let UpdatedItems=[];	


	for(let oneItem of allItems){
	let obj ={};
		let checkbox=oneItem.querySelector('.check');
		let textbox=oneItem.querySelector('.txtprice');
		let textname=oneItem.querySelector('.txt');
	if(checkbox.checked)
	{
	//obj[checkbox.value]=textbox.value	
	obj.id=checkbox.value;
	obj.price=textbox.value;
	obj.name=textname.value;
	UpdatedItems.push(obj);
	}
	}
	console.log(JSON.stringify(UpdatedItems));
	

	if(Object.keys(UpdatedItems).length !=0){
	let params = {
		"method": "POST",
		"headers": {
			"Content-Type": "application/json; charset=utf-8"
					},
		"body": JSON.stringify(UpdatedItems)
}

	fetch("PHP/php_checkbox.php", params)
	location.reload();
	}
	else
		alert("عليك اختيار صنف واحد على الأثل");

}

function fillItemCard(data){
	let itemDiv=document.createElement("div");
	itemDiv.setAttribute("class","formItem");
	
	let check=document.createElement("input");
	check.setAttribute("type","checkbox");
	check.setAttribute("class","check");
	check.setAttribute("value",data.itemId);
	
	let spn=document.createElement("span");
	spn.setAttribute("class","itemName");
	spn.appendChild(document.createTextNode(data.itemName));
	
	let txt=document.createElement("input");
	txt.setAttribute("type","text");
	txt.setAttribute("class","txtprice");
	txt.setAttribute("value",data.itemPrice);
	
	let txtName=document.createElement("input");
	txtName.setAttribute("type","text");
	txtName.setAttribute("class","txt");
	txtName.setAttribute("value",data.itemName);
	
	itemDiv.appendChild(check);
	itemDiv.appendChild(spn);
	itemDiv.appendChild(txt);
	itemDiv.appendChild(txtName);
	
	return itemDiv;

}
</script>
<!-- script for add new row button -->
<script>
let btn=document.querySelector('.addNewRow');
let frm=document.querySelector('.itemsForm');
let k=0;
btn.addEventListener("click",function(){
   
    let firstItemName=document.getElementsByClassName('newCatName')[k];
    let firstItemIamge=document.getElementsByClassName('newCatImage')[k];
    
 
if(firstItemName.value=='' || firstItemIamge=='')
{
    alert("some data is obligatory");
}
else
{
k++;   
let oneItem=document.createElement("div");
oneItem.setAttribute("class","oneItem");

	
let inputcatname=document.createElement("input");
inputcatname.setAttribute("type","text");
inputcatname.setAttribute("class","newCatName");
inputcatname.setAttribute("name","catName[]");


let inputcatimage=document.createElement("input");
inputcatimage.setAttribute("type","file");
inputcatimage.setAttribute("class","newCatImage");
inputcatimage.setAttribute("name","file[]");

let label=document.createElement("label");
label.setAttribute("class","labels");
label.appendChild(document.createTextNode('إسم الفئة'));

oneItem.appendChild(label);
oneItem.appendChild(inputcatname);
oneItem.appendChild(inputcatimage);

frm.appendChild(oneItem);
}

});
</script>
    </body>
</html>