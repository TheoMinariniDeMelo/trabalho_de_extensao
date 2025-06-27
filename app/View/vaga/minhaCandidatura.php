<?php

$candidaturas = $dados['candidaturas'];

?>

<?= exibeAlerta(); ?>

<h1 style="
    text-align: center;
    color: #2c3e50;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin-bottom: 2rem;
    font-size: 2rem;
">
    Minhas Candidaturas
</h1>

<?php if (empty($candidaturas)) : ?>
    <p style="
        text-align: center;
        font-size: 1.2rem;
        color: #7f8c8d;
        margin-bottom: 2rem;
    ">
        Você ainda não se candidatou a nenhuma vaga.
    </p>
<?php else : ?>
    <div style="overflow-x: auto; max-width: 100%; padding: 0 1rem;">
        <table style="
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
        " id="tbMinhaCandidatura">
            <thead style="background-color: #2c3e50; color: white;">
                <tr>
                    <th style="padding: 15px; text-align: center;">#</th>
                    <th style="padding: 15px;">Título da Vaga</th>
                    <th style="padding: 15px;">Descrição</th>
                    <th style="padding: 15px; text-align: center;">Data</th>
                    <th style="padding: 15px; text-align: center;">Estabelecimento</th>
                    <th style="padding: 15px; text-align: center;">Observação</th>
                    <th style="padding: 15px; text-align: center;">Status</th>
                    <th style="padding: 15px; text-align: center;">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidaturas as $index => $candidatura) : ?>
                    <tr style="background-color: <?= $index % 2 === 0 ? '#ecf0f1' : '#fff'; ?>;">
                        <td style="padding: 12px; text-align: center; font-weight: bold; color: #34495e;">
                            <?= $index + 1 ?>
                        </td>
                        <td style="padding: 12px; font-weight: 600; color: #2c3e50;">
                            <?= htmlspecialchars($candidatura['cargo_descricao']) ?>
                        </td>
                        <td style="padding: 12px; color: #7f8c8d;">
                            <?= htmlspecialchars(strlen($candidatura['vaga_descricao']) > 100 ? substr($candidatura['vaga_descricao'], 0, 100) . '...' : $candidatura['vaga_descricao']) ?>
                        </td>
                        <td style="padding: 12px; text-align: center; color: #7f8c8d;">
                            <?= date('d/m/Y H:i', strtotime($candidatura['data_candidatura'])) ?>
                        </td>
                        <td style="padding: 12px; text-align: center; color: #7f8c8d;">
                            <?= $candidatura['estabelecimento_nome'] ?>
                        </td>
                        <td style="padding: 12px; text-align: center; color: #7f8c8d;">
                            <?= htmlspecialchars($candidatura['observacao']) ?>
                        </td>
                        <td style="padding: 12px; text-align: center; font-weight: 600; color:
                            <?php
                            switch ($candidatura['status']) {
                                case 1:
                                    echo '#f39c12'; // Pendente
                                    break;
                                case 2:
                                    echo '#27ae60'; // Aprovado
                                    break;
                                case 3:
                                    echo '#c0392b'; // Rejeitado
                                    break;
                                default:
                                    echo '#7f8c8d';
                            }
                            ?>">
                            <?php
                            switch ($candidatura['status']) {
                                case 1:
                                    echo 'Pendente';
                                    break;
                                case 2:
                                    echo 'Aprovado';
                                    break;
                                case 3:
                                    echo 'Rejeitado';
                                    break;
                                default:
                                    echo 'Desconhecido';
                            }
                            ?>
                        </td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="<?= baseUrl() ?>Vaga/removerCandidatura/<?= $candidatura['id'] ?>"
                                style="
            background-color: transparent;
            border: 1px solid #c0392b;
            color: #c0392b;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
       "
                                onmouseover="this.style.backgroundColor='#c0392b'; this.style.color='#fff';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#c0392b';"
                                onclick="return confirm('Tem certeza que deseja remover sua candidatura?');">
                                Remover
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?= datatables('tbMinhaCandidatura') ?>