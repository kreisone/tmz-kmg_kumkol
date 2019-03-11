<form action="{{ route('admin.auth.material.search') }}" method="GET">
	@csrf
	<div class="input-group">
	    <input type="text" name="search" class="form-control" placeholder="Материал" aria-label="Поиск материала" aria-describedby="button-addon2">
	    <div class="input-group-append">
	        <button class="btn btn-outline-secondary" type="input" id="button-addon2">Найти</button>
	    </div>
	</div>
</form>