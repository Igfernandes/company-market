<?php

$data = array(
	"title" => "Não encontrado",
	"side" => "admin",
	"form_out",
	"side" => "user"
);

echo view('/globals/_header', $data); ?>

<div class="_404">
	<div class="_404_content">
		<div class="container-fluid container-md">
			<div class="row _404_development">
				<div class="col-12 _404_development-column">
					<div class="_404-info">
						<div class="_404-box">
							<div class="_404-box--item">
								<div class="_404-box--item-img">
									<img src="/img/icon-alvo.png" alt="Image Alvo">
								</div>
							</div>
							<div class="_404-box--item">
								<div class="_404-box--item-text">
									<p>Brasil Arco informa:</p>
									<h4>ERRO INTERNO</h4>
								</div>
							</div>
							<div class="_404-box--item">
								<div class="_404-box--item-img">
									<img src="/img/icon-alvo.png" alt="Image Alvo">
								</div>
							</div>
						</div>
						<div class="spacer-border">
							<img src="/img/faixa-style.png" alt="Image border">
						</div>
						<div class="_404-text">
							<p>Algum problema ocorreu no meio do processo! Pedimos desculpas pelo ocorrido! <br>
								Solicitamos que tente mais tarde novamente, ou refaça todo o processo seguindo as orientações corretamente.</p>
							<a href="<?= site_url()?>">Voltar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo view('/globals/_footer', $data); ?>