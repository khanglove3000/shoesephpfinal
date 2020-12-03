<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helper/format.php');


?>

<?php

class product 
{
	private $db;
	private $fm;
	public function __construct()
	{	
		$this->db = new Database();
		$this->fm = new Format();
		 
	}	

	public function search_product($tukhoa)
	{
		$tukhoa = $this->fm->validation($tukhoa);
		$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
		$result = $this->db->select($query);
		return $result;	
	}	
	
	public function insert_product($data,$files)
	{
		
				
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);	
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link,  $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];
		
		$div = explode('.',$file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		
		if($productName == '' || $brand == '' || $category == '' || $price == '' || $type == '' || $product_desc == '' || $file_name == ''   )
		{
			$alert = "<span class='error'>Fiels must be not empty</span>";
				return $alert;
		}
		else
		{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_product(productName, brandId, catId, product_desc, price, type, image ) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";	
			$result = $this->db->insert($query);
			if($result)
			{
				$alert = "<span class='success'>Insert Product Successfully</span>";
				return $alert;
			}
			else
			{
				$alert = "<span class='error'>Insert Product Not Successfully</span>";
				return $alert;	
			}
			
		}	
	}
	
	public function show_product()
	{
	
		$query = "

		SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
		INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
		order by tbl_product.productId desc";	
		
		$result = $this->db->select($query);
		return $result;
	}
	
	public function update_product($data, $files, $id)
	{
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);	
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link,  $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		
		// Kiểm tra hình ảnh và lấy hình ảnh vào folder upload
		$permited = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];
		
		$div = explode('.',$file_name);
		$file_ext = strtolower(end($div));
		// file_current = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		
		
		if($productName == '' || $brand == '' || $category == '' || $price == '' || $type == '' || $product_desc == ''  )
		{
			$alert = "<span class='error'>Fiels must be not empty</span>";
				return $alert;
		}
		else
		{
			if(!empty($file_name))
			{
				// Nếu người dùng chọn ảnh
				if($file_size > 204800)
				{
					$alert = "<span class='success'>Image size should be less then 200MB </span>";
					return $alert;
				}
				elseif(in_array($file_ext, $permited) === false)
				{
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
					$alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "UPDATE tbl_product SET 
				productName = '$productName',
				catId = '$category',
				brandId = '$brand',
				product_desc = '$product_desc',
				type = '$type',
				price = '$price',
				image = '$unique_image'
				WHERE productId = '$id'";
			}
			else
			{
				// Nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET 
				productName = '$productName',
				brandId = '$brand',
				catId = '$category',
				type = '$type',
				price = '$price',
				product_desc = '$product_desc'
				WHERE productId = '$id'";
			}

			$result = $this->db->update($query);
			if($result)
			{
				$alert = "<span class='success'>Product Update Successfully</span>";
				return $alert;
			}
			else
			{
				$alert = "<span class='error'>Product Update Not Successfully</span>";
				return $alert;	
			}
			
		}	
				
	}
	
	public function del_product($id)
	{
		$query = "DELETE  FROM tbl_product where productId = '$id'";	
		$result = $this->db->delete($query);
		if($result)
			{
				$alert = "<span class='success'>Product Deleted Successfully</span>";
				return $alert;
			}
			else
			{
				$alert = "<span class='error'>Product Deleted Not Successfully</span>";
				return $alert;	
			}
		
	}
	
	
	public function getproductbyId($id)
	{
		$query = "SELECT * FROM tbl_product where productId = '$id'";	
		$result = $this->db->select($query);
		return $result;
		
	}
	
	// End Backed
	public function getproduct_feathered()
	{
		$query = "SELECT * FROM tbl_product where type = '0'";	
		$result = $this->db->select($query);
		return $result;
	}


	public function getproduct_new()
	{

		$sp_tungtrang = 4;
		if(!isset($_GET['trang']))
		{
			$trang = 1;
		}
		else
		{
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*$sp_tungtrang;
		$query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang, $sp_tungtrang";	
		$result = $this->db->select($query);
		return $result;
	}

	public function get_all_product()
	{
		$query = "SELECT * FROM tbl_product";	
		$result = $this->db->select($query);
		return $result;
	}


	public function get_details($id)
	{
		$query = "

		SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
		INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'
		";	
		
		$result = $this->db->select($query);
		return $result;

	}

	public function getLastestAdidas()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '11' order by productId desc LIMIT 1";	
		$result = $this->db->select($query);
		return $result;
	}

	public function getLastestNike()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '12' order by productId desc LIMIT 1";	
		$result = $this->db->select($query);
		return $result;
	}

	public function getLastestConverse()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '13' order by productId desc LIMIT 1";	
		$result = $this->db->select($query);
		return $result;
	}

	public function getLastestNew_Balance()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '14' order by productId desc LIMIT 1";	
		$result = $this->db->select($query);
		return $result;
	}


	

	
}

?>