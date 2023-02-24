<h1>Create New Cupom<h1>

        <div>
            <form action="{{ route('cupom.store') }}" method="post">
                @csrf
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
                    <input type="text" name="nome" class="form-control">
                </div>
                <div class="form-group">
                    <label class="text-black font-w500">Desconto(%)</label>
                    <input type="number" name="descount" class="form-control">
                </div>

                <div class="form-group">
                    <label class="text-black font-w500">Data de Expiração</label>
                    <input type="date" name="experation_date" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Criar</button>
                </div>
            </form>
        </div>
