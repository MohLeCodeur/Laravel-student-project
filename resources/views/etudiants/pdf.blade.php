<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Liste des Étudiants</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; text-align: center; font-size: 9px; }
        .page-break { page-break-after: always; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des Étudiants</h1>
        <p>Exporté le: {{ \Carbon\Carbon::now()->isoFormat('LLLL') }}</p>
        @if(request('search'))
        <p>Filtre de recherche appliqué : "{{ request('search') }}"</p>
        @endif
        <p>Trié par : {{ ucfirst(str_replace('_', ' ', $sortBy)) }} ({{ $sortDirection == 'asc' ? 'Ascendant' : 'Descendant' }})</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date de Naissance</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->id }}</td>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($etudiant->date_naissance)->isoFormat('DD/MM/YYYY') }}</td>
                    <td>{{ $etudiant->adresse }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Aucun étudiant trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Projet Laravel Étudiants - Page <script type="text/php">echo $PAGE_NUM."/".$PAGE_COUNT;</script>
    </div>
</body>
</html>