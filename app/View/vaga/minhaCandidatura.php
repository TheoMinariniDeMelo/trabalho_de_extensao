<?php $candidaturas = $dados['candidaturas']; ?>

<h1 style="text-align:center; color:#2c3e50; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-bottom:1rem;">
    Minhas Candidaturas
</h1>

<?php if (empty($candidaturas)): ?>
    <p style="text-align:center; font-size:1.2rem; color:#555;">
        Você ainda não se candidatou a nenhuma vaga.
    </p>
<?php else: ?>
    <div style="overflow-x:auto; max-width:100%; padding:0 1rem;">
        <table style="
            width: 100%;
            border-collapse: collapse;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            ">
            <thead style="background-color:#3498db; color:white;">
                <tr>
                    <th style="padding:12px 15px; text-align:center;">#</th>
                    <th style="padding:12px 15px;">Título da Vaga</th>
                    <th style="padding:12px 15px;">Descrição</th>
                    <th style="padding:12px 15px; text-align:center;">Data da Candidatura</th>
                    <th style="padding:12px 15px; text-align:center;">Status</th>
                    <th style="padding:12px 15px; text-align:center;">Remover</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidaturas as $index => $candidatura): ?>
                    <tr style="background-color: <?= $index % 2 === 0 ? '#f9fbfd' : 'white' ?>;">
                        <td style="padding:10px 15px; text-align:center; font-weight:bold; color:#34495e;">
                            <?= $index + 1 ?>
                        </td>
                        <td style="padding:10px 15px; font-weight:600; color:#2c3e50;">
                            <?= htmlspecialchars($candidatura['cargo_descricao']) ?>
                        </td>
                        <td style="padding:10px 15px; color:#555;">
                            <?= htmlspecialchars(strlen($candidatura['vaga_descricao']) > 100 ? substr($candidatura['vaga_descricao'], 0, 100) . '...' : $candidatura['vaga_descricao']) ?>
                        </td>
                        <td style="padding:10px 15px; text-align:center; color:#7f8c8d;">
                            <?= date('d/m/Y H:i', strtotime($candidatura['data_candidatura'])) ?>
                        </td>
                        <td style="padding:10px 15px; text-align:center; font-weight:600; color:
                            <?php
                            switch ($candidatura['status']) {
                                case 1:
                                    echo '#f39c12';
                                    break;
                                case 2:
                                    echo '#27ae60';
                                    break;
                                case 3:
                                    echo '#c0392b';
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
                        <td style="padding:10px 15px; text-align:center;">
                            <button style="
                                background-color:transparent;
                                border:1px solid #e74c3c;
                                color:#e74c3c;
                                padding:4px 10px;
                                border-radius:4px;
                                cursor:pointer;
                                transition: all 0.3s;
                            " onmouseover="this.style.backgroundColor='#e74c3c'; this.style.color='#fff';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#e74c3c';">
                                Remover
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>