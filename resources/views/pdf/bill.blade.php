<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture {{ $bill->id . '-'   . $bill->period_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            margin-bottom: 40px;
        }
        .facture-info {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURE</h1>
        <p>N° {{ $bill->id }}</p>
        <p>Date : {{ $bill->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="facture-info">
        <div style="float: left;">
            <strong>Émetteur :</strong><br>
            {{ auth()->user()->name }}<br>

        </div>
        <div style="float: right;">
            <strong>Client :</strong><br>
            {{ $bill->contract->tenant->name }}<br>
            {{ $bill->contract->tenant->address }}<br>
            {{ $bill->contract->tenant->email }}
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Période</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Location Box : {{ $bill->contract->box->name }}</td>
                <td>{{ $bill->period_number }}</td>
                <td>{{ $bill->paiement_montant }} €</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total TTC : {{ $bill->paiement_montant }} €</strong></p>
    </div>

    <div style="margin-top: 40px;">
        <p>Date de paiement :
            @if (strtotime($bill->payment_date))
                {{ $bill->payment_date->format('d/m/Y') }}
            @else
                Non payé
            @endif
        </p>
    </div>
</body>
</html>