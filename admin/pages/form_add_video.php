		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">



						<form class="animated shake" action="videos.php" method="post" enctype="multipart/form-data" style="margin-top:20px;">

								<div class="form-group">
										<label for="">Titre:</label>
										<input type="text" name="titre" placeholder=""class="form-control" id="" required>
								</div>
								<div class="form-group">
										<label for="">Url (embed format):</label>
										<input type="text" name="url"  placeholder="http://www/embed/" class="form-control" id=""required>
								</div>
								<div class="form-group">
										<label for="">Auteur:</label>
										<input type="text" name="auteur" placeholder=""class="form-control" id=""required>
								</div>
								<div class="form-group">
									  <label for="categorie">Catégorie:</label>
									  <select class="form-control" id="categorie" name="categorie"required style="background:orange;">
										<option value="0">Choisissez une catégorie</option>
										<?php
										$sql = "SELECT * FROM categories";
										$rep = mysqli_query($conn,$sql);
										if(mysqli_num_rows($rep)>0){ 
											while($data=mysqli_fetch_assoc($rep)){ ?>
												<option value='<?=$data['id_categorie']?>'><?=$data['nom']?></option>
										<?php	}
											}
										?>	
									  </select>
								</div>
								<div class="form-group">
										<label for="">Vignette Image:</label>
										<input style="background:orange;"type="button" value="Choisir une image"class="form-control" id="vignetteclick" onclick="document.getElementById('vignette').click();">
										<input type="file" name="vignette" placeholder=""class="form-control" id="vignette"style="display:none;">
								</div>
								<div class="form-group">
										<label for="">Vignette URL:</label>
										<input type="url" name="vignette_url"class="form-control" id="vignette_url">
								</div>							
								<div class="form-group">
										<textarea name="description" style="width:100%;max-width:100%;" rows=10 required> </textarea> 
								</div>

								<div class="form-group">
										<label class="checkbox-inline"><input type="checkbox" class="checkbox" name="publication"> Mettre en ligne ?</label>
								</div>
								
								<input type="submit"name="sendAjouter"value="ajouter" class="btn btn-success btn-md">
						</form><!-- END Form -->


				</div><!-- END col -->
			</div><!-- END row -->
		</div><!-- END CONTAINER -->