<main>
	<section>
		<a href="index.php"><button class="btn btn-success mt-5">Voltar</button></a>
	</section>

	<h2 class="mt-3"><?=TITLE?></h2>

	<form method="post">

		<div class="form-group">
      <label>Título</label>
      <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
    </div>

    <div class="form-group">
      <label>Descrição</label>
      <textarea class="form-control" name="descricao" rows="5"><?=$obVaga->descricao?></textarea>
    </div>

    <div class="form-group mt-3">
    	<label>Status</label>

        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="ativo" value="s" checked> Ativo
          </label>
        </div>

        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="ativo" value="n" <?=$obVaga->ativo == 'n' ? 'checked' : ''?>> Inativo
          </label>
        </div>
    </div>

    <div class="form-group mt-4">
    	<button class="btn btn-success" type="submit">Enviar</button>   	
    </div>		
	</form>
</main>

     
