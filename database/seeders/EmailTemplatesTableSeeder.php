<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->delete();

        DB::table('email_templates')->insert(array(
            0 =>
            array(
                'id' => 1,
                'act' => 'PASS_RESET_CODE',
                'name' => 'Redefinir Senha',
                'subj' => 'Redefinir Senha',
                'email_body' => '<p style="margin: 10px 0;"> Recebemos uma solicitação para redefinir a senha da sua conta em <b>{{time}}</b>.</p>
<p style="margin: 10px 0;">Solicitado a partir do IP: <b>{{ip}}</b> usando <b>{{browser}}</b> no <b>{{operating_system}}</b>.</p>
<br>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center"
style="background-color: #fccf00; background-image: linear-gradient(180deg, #fccf00 0%, #e40007 74%); padding: 6px 20px; border-radius: 12px;">
<a href="{{code}}" target="_blank"
style="color: #fff; text-decoration: none; font-weight: bold;">Redefinir Senha</a>
</td>
</tr>
</table>',
                'shortcodes' => ' {"code":"Password Reset Code","ip":"IP of User","browser":"Browser of User","operating_system":"Operating System of User","time":"Request Time"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:24:04',
                'updated_at' => '2024-03-28 16:35:37',
            ),
            1 =>
            array(
                'id' => 2,
                'act' => 'PASS_RESET_DONE',
                'name' => 'Senha Redefinida',
                'subj' => 'Senha Redefinida',
                'email_body' => '<p style="margin: 10px 0;">Você redefiniu sua senha com sucesso.</p>
<p style="margin: 10px 0;">Você alterou de IP: <b>{{ip}}</b> usando <b>{{browser}}</b> em <b>{{operating_system}}</b> em <b>{{time}}</b></p>
<br>
<p style="margin: 10px 0;"><b>Se você não fez essa alteração, entre em contato conosco o mais rápido possível.</b></font></p>',
                'shortcodes' => '{"ip":"IP of User","browser":"Browser of User","operating_system":"Operating System of User","time":"Request Time"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:28:23',
                'updated_at' => '2024-03-28 16:35:20',
            ),
            2 =>
            array(
                'id' => 3,
                'act' => 'EVER_CODE',
                'name' => 'Verificação de E-mail',
                'subj' => 'Verificação de E-mail',
                'email_body' => '<p style="margin: 10px 0;">Obrigado por se juntar a nós.</p>
<br>
<p style="margin: 10px 0;">Seu código de verificação de e-mail é: <b>{{code}}</b>.</p>',
                'shortcodes' => '{"code":"Email Verification code"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:28:23',
                'updated_at' => '2024-03-28 16:36:07',
            ),
            3 =>
            array(
                'id' => 4,
                'act' => '2FA_ENABLE',
                'name' => 'Ativação de Dois Fatores',
                'subj' => 'Ativação de Dois Fatores',
                'email_body' => '<p style="margin: 10px 0;">Você acabou de ativar a Autenticação de Dois Fatores do para sua conta.</p>
<p style="margin: 10px 0;">Ativado em <b>{{time}}</b> a partir do IP: <b>{{ip}}</b> usando <b>{{browser}}</b> em <b>{{operating_system}}</b>.</p>',
                'shortcodes' => '{"ip":"IP of User","browser":"Browser of User","operating_system":"Operating System of User","time":"Request Time"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:30:32',
                'updated_at' => '2024-03-28 16:38:04',
            ),
            4 =>
            array(
                'id' => 5,
                'act' => '2FA_DISABLE',
                'name' => 'Desativação de Dois Fatores',
                'subj' => 'Desativação de Dois Fatores',
                'email_body' => '<p style="margin: 10px 0;">Você acabou de desativar a Autenticação de Dois Fatores de sua conta.</p>
<p style="margin: 10px 0;">Desativado em <b>{{time}}</b> a partir do IP: <b>{{ip}}</b> usando <b>{{browser}}</b> em <b>{{operating_system}}</b>.</p>',
                'shortcodes' => '{"ip":"IP of User","browser":"Browser of User","operating_system":"Operating System of User","time":"Request Time"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:30:32',
                'updated_at' => '2024-03-28 16:39:30',
            ),
            5 =>
            array(
                'id' => 6,
                'act' => 'DEPOSIT_COMPLETE',
                'name' => 'Depósito Concluído',
                'subj' => 'Depósito Concluído',
                'email_body' => '<p style="margin: 10px 0;">Seu depósito de <b>R${{amount}} </b> via <b>PIX</b> foi concluído com sucesso<b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Seu saldo atual é de <b>{{post_balance}} {{currency}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","method_name":"Deposit Method Name"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:35:33',
                'updated_at' => '2024-03-28 16:42:07',
            ),
            6 =>
            array(
                'id' => 7,
                'act' => 'DEPOSIT_REQUEST',
                'name' => 'Depósito Requisitado',
                'subj' => 'Depósito Requisitado',
                'email_body' => '<p style="margin: 10px 0;">Seu depósito de <b>R${{amount}} </b> via <b>{{method_name}}</b> foi requisitado com sucesso<b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Seu saldo atual é de <b>{{post_balance}} {{currency}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","rate":"Conversion Rate","method_name":"Deposit Method Name","method_currency":"Deposit Method Currency","method_message":"Withdraw Payment Message"}',
                'email_status' => 1,
                'created_at' => '2022-03-25 04:35:33',
                'updated_at' => '2024-03-28 16:45:19',
            ),
            7 =>
            array(
                'id' => 8,
                'act' => 'WITHDRAW_REQUEST',
                'name' => 'Solicitação de Saque',
                'subj' => 'Solicitação de Saque',
                'email_body' => '<p style="margin: 10px 0;">Sua solicitação de saque de <b>R${{amount}} </b> via <b>{{method_name}}</b> foi enviada com sucesso<b>.</p>
<p style="margin: 10px 0;">Isso pode levar {{delay}} para processar o pagamento.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Seu saldo atual é de <b>{{post_balance}} {{currency}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","rate":"Conversion Rate","method_name":"Withdraw Method Name","method_amount":"Withdraw Method Amount After Conversion","method_currency":"Withdraw Method Currency","post_balance":"Your current Balance","delay":"Delay time for processing"}',
                'email_status' => 1,
                'created_at' => '2022-10-22 04:35:33',
                'updated_at' => '2024-03-28 16:48:13',
            ),
            8 =>
            array(
                'id' => 9,
                'act' => 'WITHDRAW_REJECT',
                'name' => 'Solicitação de Saque Rejeitada',
                'subj' => 'Solicitação de Saque Rejeitada',
                'email_body' => '<p style="margin: 10px 0;">Sua solicitação de saque de <b>R${{amount}} </b> via <b>{{method_name}}</b> foi rejeitada<b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Valor do Saque: <b>R${{amount}} </b></p>
<br>
<p style="margin: 10px 0;">Detalhes da Rejeição: <b>{{method_message}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","rate":"Conversion Rate","method_name":"Withdraw Method Name","method_currency":"Withdraw Method Currency","method_message":"Withdraw Payment Message"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:35:33',
                'updated_at' => '2024-03-28 17:22:46',
            ),
            9 =>
            array(
                'id' => 10,
                'act' => 'WITHDRAW_APPROVE',
                'name' => 'Solicitação de Saque Foi Processada',
                'subj' => 'Solicitação de Saque Foi Processada',
                'email_body' => '<p style="margin: 10px 0;">Sua solicitação de saque de <b>R${{amount}} </b> via <b>{{method_name}}</b> foi processada com sucesso<b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Valor do saque: <b>R${{amount}}</b></p>
<br>
<p style="margin: 10px 0;">Detalhes da Transação: <b>{{method_message}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","rate":"Conversion Rate","method_name":"Withdraw Method Name","method_currency":"Withdraw Method Currency","method_message":"Withdraw Payment Message"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:35:33',
                'updated_at' => '2024-03-28 17:17:05',
            ),
            10 =>
            array(
                'id' => 11,
                'act' => 'DEPOSIT_APPROVE',
                'name' => 'Solicitação de Depósito Processada',
                'subj' => 'Solicitação de Depósito Processada',
                'email_body' => '<p style="margin: 10px 0;">Sua solicitação de depósito de <b>R${{amount}} </b> via <b>{{method_name}}</b> foi processada com sucesso<b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Valor do Depósito: <b>R${{amount}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","rate":"Conversion Rate","method_name":"Deposit Method Name","method_currency":"Deposit Method Currency"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:35:33',
                'updated_at' => '2024-03-28 18:04:03',
            ),
            11 =>
            array(
                'id' => 12,
                'act' => 'DEPOSIT_REJECT',
                'name' => 'Solicitação de Depósito Rejeitada',
                'subj' => 'Solicitação de Depósito Rejeitada',
                'email_body' => '<p style="margin: 10px 0;">Sua solicitação de depósito de <b>R${{amount}} </b> via <b>{{method_name}}</b> foi rejeitada<b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Valor do Depósito: <b>R${{amount}} </b></p>
<br>
<p style="margin: 10px 0;">Detalhes da Rejeição: <b>{{method_message}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","amount":"Request Amount By user","charge":"Gateway Charge","currency":"Site Currency","rate":"Conversion Rate","method_name":"Deposit Method Name","method_currency":"Deposit Method Currency"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:35:33',
                'updated_at' => '2024-03-28 17:22:32',
            ),
            12 =>
            array(
                'id' => 13,
                'act' => 'ADMIN_SUPPORT_REPLY',
                'name' => 'Resposta ao Ticket de Suporte',
                'subj' => 'Resposta ao Ticket de Suporte',
                'email_body' => '<p style="margin: 10px 0;">Um membro da nossa equipe de suporte respondeu ao seguinte ticket: </b>{{trx}}<b>.</p>
<br>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center"
style="background-color: #fccf00; background-image: linear-gradient(180deg, #fccf00 0%, #e40007 74%); padding: 6px 20px; border-radius: 12px;">
<a href="{{link}}" target="_blank"
style="color: #fff; text-decoration: none; font-weight: bold;">Responder Ticket</a>
</td>
</tr>
</table>
<br>
<p style="margin: 10px 0;">Resposta: <b>{{reply}}</b></p>',
                'shortcodes' => '{"ticket_id":"Support Ticket ID", "ticket_subject":"Subject Of Support Ticket", "reply":"Reply from Staff/Admin","link":"Ticket URL For reply"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:01:41',
                'updated_at' => '2024-03-28 17:36:02',
            ),
            13 =>
            array(
                'id' => 14,
                'act' => 'REFERRAL_COMMISSION',
                'name' => 'Bônus de Comissão Recebido',
                'subj' => 'Bônus de Comissão Recebido',
                'email_body' => '<p style="margin: 10px 0;">Você recebeu um bônus de comissão de <b>R${{amount}}</b>.</p>
<p style="margin: 10px 0;">Valor do Bônus: <b>R${{amount}} </b></p>',
                'shortcodes' => '{"amount":"Commission Amount","post_balance":"Users Balance After this operation","level":"Level","currency":"Site Currency"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:01:41',
                'updated_at' => '2024-03-28 17:30:23',
            ),
            14 =>
            array(
                'id' => 15,
                'act' => 'BAL_ADD',
                'name' => 'Saldo Creditado',
                'subj' => 'Saldo Creditado',
                'email_body' => '<p style="margin: 10px 0;">Foi creditado na sua conta o valor de <b>R${{amount}}</b> via <b>administrador</b>.</p>
<p style="margin: 10px 0;">Valor do Crédito: <b>R${{amount}}</b></p>
<br>
<p style="margin: 10px 0;">Detalhe da Transação: <b>{{post_message}}</b></p>',
                'shortcodes' => '{"amount":"Request Amount By Admin","currency":"Site Currency", "post_balance":"Users Balance After this operation","post_message":"Balance add Message"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:04:44',
                'updated_at' => '2024-03-28 17:33:48',
            ),
            15 =>
            array(
                'id' => 16,
                'act' => 'BAL_SUB',
                'name' => 'Saldo Debitado',
                'subj' => 'Saldo Debitado',
                'email_body' => '<p style="margin: 10px 0;">Foi debitado de sua conta o valor de <b>R${{amount}}</b> via <b>administrador</b>.</p>
<p style="margin: 10px 0;">Valor do Débito: <b>R${{amount}}</b></p>
<br>
<p style="margin: 10px 0;">Detalhe da Transação: <b>{{post_message}}</b></p>',
                'shortcodes' => '{"amount":"Request Amount By Admin","currency":"Site Currency", "post_balance":"Users Balance After this operation","post_message":"Balance Deduct Message"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:07:08',
                'updated_at' => '2024-03-28 18:04:13',
            ),
            16 =>
            array(
                'id' => 17,
                'act' => 'BET_PLACED',
                'name' => 'Aposta Realizada',
                'subj' => 'Aposta Realizada',
                'email_body' => '<p style="margin: 10px 0;">Sua aposta foi realizada com sucesso no valor <b>R${{invest_amount}} </b> realizada em <b>{{option}}</b>.</p>
<p style="margin: 10px 0;">Número da Transação: {{trx}}</p>
<p style="margin: 10px 0;">Valor da Aposta: <b>R${{invest_amount}} </b></p>
<p style="margin: 10px 0;">Valor da Retorno: <b>R${{return_amount}} </b></p>
<br>
<p style="margin: 10px 0;">Competidor: <b>{{match}}</b></p>
<p style="margin: 10px 0;">Aposta em: <b>{{option}}</b></p>
<p style="margin: 10px 0;">Pergunta: <b>{{question}}</b></p>',
                'shortcodes' => '{"trx":"Transaction Number","invest_amount":"Invested Amount By User For Bet","return_amount":"Return Amount For User If Win Bet","currency":"Site Currency", "post_balance":"Users Balance After This Operation","match":"Match Name","question":"Question","option":"Option"}',
                'email_status' => 1,
                'created_at' => '2022-10-25 04:04:44',
                'updated_at' => '2024-03-28 18:02:20',
            ),
        ));
    }
}
