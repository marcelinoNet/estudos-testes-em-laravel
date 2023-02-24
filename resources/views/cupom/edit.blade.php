<h1>Edit Cupom<h1>

    <div>
        <form action="{{ route('cupom.update', $cupom->id) }}" method="post">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label class="text-black font-w500">Nome</label>
                <input type="text" name="nome" value="{{$cupom->name}}" class="form-control">
            </div>
            <div class="form-group">
                <label class="text-black font-w500">Desconto(%)</label>
                <input type="number" name="descount" value="{{$cupom->descount}}" class="form-control">
            </div>

            <div class="form-group">
                <label class="text-black font-w500">Data de Expiração</label>
                <input type="date" name="experation_date" value="{{$cupom->experation_date}}" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>
        </form>
    </div>
