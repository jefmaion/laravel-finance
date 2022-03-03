<form id="form-transaction" method="POST" action="{{ route('transaction.update', $transaction) }}">
    @method('PUT')
    @include('transaction.form')
</form>