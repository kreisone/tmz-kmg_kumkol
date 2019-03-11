<form action="{{ route('admin.auth.group_of_personnel.search') }}" method="GET">
	@csrf
	<div class="input-group">
	    <input type="text" name="search" class="form-control" placeholder="Группы персонала" aria-label="Поиск группы персонала" aria-describedby="button-addon2">
	    <div class="input-group-append">
	        <button class="btn btn-outline-secondary" type="input" id="button-addon2">Найти</button>
	    </div>
	</div>
</form>