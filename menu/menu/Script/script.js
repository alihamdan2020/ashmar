
//async mean, when project load,
//i dont need to wait your response of this function, the DOM will be rendered
//and when function get its response, the result appear

async function loadData(){
    const sectionsResponse=await fetch("PHP/conn.php");
    const sections=await sectionsResponse.json();
    //....json() mean convert answer of fetch to JSON    
    const itemsResponse=await fetch("PHP/getItems.php");
    const items=await itemsResponse.json();
    
    addMenuAndCategoriesSection(sections);
    addItems(items);
//can not use items and itemsREsponse out of async function
}


loadData();


//below function to dynamically fill nav menu ad section for each categories

let nav=document.getElementsByClassName("nav-categories")[0];
let categories=document.getElementById("categories");

function addMenuAndCategoriesSection(data){
	
	for(i=0;i<data.length;i++)
	{
		let li=document.createElement("li");
		let a= document.createElement("a");
		a.setAttribute("class","a");
		a.setAttribute("href","#cat"+data[i].catId);
		a.appendChild(document.createTextNode(data[i].catName));
		li.appendChild(a);
		nav.appendChild(li);
		
		let div = document.createElement("div");
		div.setAttribute("class","cats");
		div.setAttribute("id","cat"+data[i].catId);
		
		let div_design=document.createElement("div");
		div_design.setAttribute("class","decoration");
	
		let div_image_heading=document.createElement("div");
		div_image_heading.setAttribute("class","heading_img");
		let heading=document.createElement("h1");
		heading.appendChild(document.createTextNode(data[i].catName));
		div_image_heading.appendChild(heading);
		
		let productImage=document.createElement("div");
		productImage.setAttribute("class","product-img");
		let img=document.createElement("img");
		img.setAttribute("class","img");
		img.setAttribute("src","./images/"+data[i].catImage);
		img.setAttribute("alt","picture not exist");
		img.setAttribute("onerror","this.src='./images/logo.png'");
    	productImage.appendChild(img);
		
		div_image_heading.appendChild(heading);
		div_image_heading.appendChild(productImage);
		
		div.appendChild(div_design);
		div.appendChild(div_image_heading);
		
		let productsCard=document.createElement("div");
		productsCard.setAttribute("class","cat");
		div.appendChild(productsCard);
		
		categories.appendChild(div);
	}
}



var cat=document.getElementsByClassName("cat");
function addItems(data){
for(i=0;i<data.length;i++)
{
	switch(data[i].catId)
	{
		case "1" : cat[0].appendChild(fillItemCard(data[i]));
				 break;
		case "2" : cat[1].appendChild(fillItemCard(data[i]));
				 break;
		case "3" : cat[2].appendChild(fillItemCard(data[i]));
				 break;
		case "4" : cat[3].appendChild(fillItemCard(data[i]));
				 break;
        case "6" : cat[4].appendChild(fillItemCard(data[i]));
				 break;
		case "7" : cat[5].appendChild(fillItemCard(data[i]));
				 break;
		case "8" : cat[6].appendChild(fillItemCard(data[i]));
				 break;
		case "9" : cat[7].appendChild(fillItemCard(data[i]));
				 break;
		case "10" : cat[8].appendChild(fillItemCard(data[i]));
				 break;
		case "11" : cat[9].appendChild(fillItemCard(data[i]));
				 break;
		
	}

}
}


function fillItemCard(data){
	let productCard=document.createElement("div");
	productCard.setAttribute("class","product");
	
	let productDetail=document.createElement("div");
	productDetail.setAttribute("class","product-detail");
	
	let productEnglishName=document.createElement("p");
	productEnglishName.setAttribute("class","englishname");
	productEnglishName.appendChild(document.createTextNode(data.itemNameEnglish));
	let productName=document.createElement("p");
	productName.setAttribute("class","productname");
	productName.appendChild(document.createTextNode(data.itemName));
	
	let productPrice=document.createElement("p");
	productPrice.setAttribute("class","productprice");
	productPrice.appendChild(document.createTextNode(Number(data.itemPrice).toLocaleString('en-US') + " ل.ل"));
	productDetail.appendChild(productName);
	productDetail.appendChild(productEnglishName);
	productDetail.appendChild(productPrice);
	
//	productCard.appendChild(productImage);
	productCard.appendChild(productDetail);
	
	return productCard;
}