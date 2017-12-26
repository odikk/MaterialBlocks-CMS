<?php
	/*
			MaterialBlocks - Froala design-blocks based CMS
			Copyright (C) 2017  Robin Krause
	
			This program is free software: you can redistribute it and/or modify
			it under the terms of the GNU General Public License as published by
			the Free Software Foundation, either version 3 of the License, or
			(at your option) any later version.
	
			This program is distributed in the hope that it will be useful,
			but WITHOUT ANY WARRANTY; without even the implied warranty of
			MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
			GNU General Public License for more details.
	
			You should have received a copy of the GNU General Public License
			along with this program.  If not, see <http://www.gnu.org/licenses/>.
		*/
		
		function LoginForm() {
	?>
	<section class="fdb-block fdb-viewport" style="background-color: #242424; color: #EEE;">
    	<div class="container justify-content-center align-items-center d-flex">
      		<div class="row justify-content-center text-center">
        		<div class="col-12 col-md-8">
          			<h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
          			<p class="text-h2">Log In to Access the Dashboard.</p>
        		</div>
      		</div>
    	</div>
  	</section>
	<section class="fdb-block" style="background-color: #212121; color: #eee;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-7 col-xl-5 text-center">
					<div class="fdb-box">
						<div class="row">
							<div class="col">
								<h1>Log In</h1>
							</div>
						</div>
						<form action="index.php?site=dashboard&action=login" method="post">
							<div class="row mt-4">
								<div class="col">
									<input class="form-control" name="email" placeholder="Email" type="email" required>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col">
									<input class="form-control mb-1" name="password" placeholder="Password" type="password" required>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col">
									<button class="btn btn-empty btn-round" type="submit">Log In <i class="fa fa-angle-right" aria-hidden="true"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	}
?>
