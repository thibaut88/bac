						//ajax delete an user
						function delete_user_admin(id){
								var url = "../scripts/deleteUser.php";
								var data = 'id='+id;
								$.ajax({
										type:'POST',
										url:url,
										data:data,
										dataType:'html',
										success:function(result){
											console.log(result);
											$('table').after(result);
											
										}
									});	
						}