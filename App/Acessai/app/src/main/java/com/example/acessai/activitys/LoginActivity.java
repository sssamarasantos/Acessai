//pacote
package com.example.acessai.activitys;

//classes importadas 
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import com.example.acessai.R;
import com.example.acessai.classes.Metodos;
import com.example.acessai.classes.Session;
import com.example.acessai.fragments.HomeFragment;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;

//classe da activity
public class LoginActivity extends AppCompatActivity {

    //declaração das variáveis
    private EditText login, senha, campo;
    private VideoView videoLibras;
    private Button entrar, cadastrar, esqueceuSenha, tbConosco;
    private ImageButton falar;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private String host = "http://acessai1.000webhostapp.com/app";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret = "";
    boolean dadosValidados;
    private String loginx, senhax;
    public static String loginu;
    private final int ID_TEXTO_PARA_VOZ = 100;

    //instância do classe Metodos
    Metodos metodo = new Metodos();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        //instâncias dos elementos da tela
        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        frameLogin = (FrameLayout) findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) findViewById(R.id.frameLibras);
        libras = (ToggleButton) findViewById(R.id.tbLibras);
        falar = (ImageButton) findViewById(R.id.btnImgFalar);
        login = (EditText) findViewById(R.id.txtLogin);
        senha = (EditText) findViewById(R.id.txtSenhaL);
        entrar = (Button) findViewById(R.id.btnLogar);
        cadastrar = (Button) findViewById(R.id.btnCadastrar);
        esqueceuSenha = (Button) findViewById(R.id.btnEsqueceuSenha);
        tbConosco = (Button) findViewById(R.id.btnTbConosco);

	//deixa o botão falar desabilitado
        falar.setEnabled(false);

        //evento de foco login
        login.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
		//atribui o valor do edittext login para o campo
                campo = login;

		//deixa o botão falar habilitado
                falar.setEnabled(true);
            }
        });
        //evento de foco senha
        senha.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
		//atribui o valor do edittext senha para o campo
                campo = senha;

		//deixa o botão falar habilitado
                falar.setEnabled(true);
            }
        });

        //evento do botão logar
        entrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//atribui o valor digitado da edittext login para loginx
                loginx = login.getText().toString();

		//atribui o valor digitado da edittext senha para senhax
                senhax = senha.getText().toString();
		
		//chama o metodo voltar
                logar();
            }
        });

        //evento do botao cadastrar
        cadastrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//instancia o intent e atribui de qual activity vai partir e para qual vai
                Intent objCadastro = new Intent(LoginActivity.this, CadastroActivity.class);

		//chama o objeto instanciado
                startActivity(objCadastro);

		//finaliza a activity
                LoginActivity.this.finish();
            }
        });

        //evento do botao esqueceuSenha
        esqueceuSenha.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//instancia o intent e atribui de qual activity vai partir e para qual vai
                Intent objEsqueceu = new Intent(LoginActivity.this, EsqueceuSenhaActivity.class);
		
		//chama o objeto instanciado
                startActivity(objEsqueceu);

		//finaliza a activity
                LoginActivity.this.finish();
            }
        });

        //evento do botao falar
        falar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//instancia um intent para chamar a o reconhecimento de voz
                Intent iVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);

		//busca o idioma
                iVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);

		//busca o local onde deverá aparecer
                iVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());

		//mostra a caixa de dialogo com o texto 
                iVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

		//verifica se o dispositivo tem suporte para o recurso
                try {
                    startActivityForResult(iVoz, ID_TEXTO_PARA_VOZ);
                } catch (ActivityNotFoundException a){
                    metodo.alerta("Dispositivo não suporta!", LoginActivity.this);
                }
            }
        });

	//deixa a tela do video libras escondido
        frameLibras.setVisibility(View.INVISIBLE);

	//evento do botao libras
        libras.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
		//se o botao estiver no modo ligar (selecionado)
                if (isChecked) {
		    //atribui um texto vazio
                    libras.setText("");

		    //deixa a tela do video libras visivel
                    frameLibras.setVisibility(View.VISIBLE);

                    //chama o video de libras
                    String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video_tela_cadastro;

		    //chama o metodo video que esta na classe metodos, responsavel por reproduzir o video
                    metodo.video(videoLibras, videoPath);

 		//caso contrário
                } else {
		    //atribui um texto vazio
                    libras.setText("");

		    //deixa a tela do video libras escondido
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
	
	//evento do botão trabalhe conosco
        tbConosco.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//instancia o endereço web para qual se quer ir
                Uri acessar = Uri.parse("http://acessai1.000webhostapp.com/site/trabalhe.php");

		//instancia o intent e coloca a ação e a variavel com o endereço
                Intent i = new Intent(Intent.ACTION_VIEW, acessar);

		//inicializa a activity
                startActivity(i);
            }
        });
    }

    //Metodo logar
    public void logar(){
	
	//recebe o valor que estabele se os dados digitados estão corretos
        dadosValidados = validarCampos();

	//se os dados estiverem corretos
        if (dadosValidados) {

	    //chama o endereço onde esta localizado o php
            url = host + "/login.php";

	    //declara o contexto
            Ion.with(LoginActivity.this)

		    //carrega o url
                    .load(url)

		    //manda os valores digitados
                    .setBodyParameter("usuario", loginx)
                    .setBodyParameter("senha", senhax)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
			    //recebe os resultados e manda para a variavel ret
                            ret = result.get("status").getAsString();

			    //verifica o valor recebido
                            if (ret.equals("ok")) {
                                loginu = loginx;
				
				//guarda os valores de login na "sessao"
                                Session session = new Session(LoginActivity.this);
                                session.criarSessao(loginx, senhax);

				//instancia o intent e atribui de qual activity vai partir e para qual vai
                                Intent objLogin = new Intent(LoginActivity.this, HomeActivity.class);
                                
				//chama o objeto instanciado
				startActivity(objLogin);

				//finaliza a activity
                                LoginActivity.this.finish();
                            } else {
				//chama o metodo alerta da classe Metodos, que exibe um alerta na tela
                                metodo.alerta("Algo deu errado :(", LoginActivity.this);
				
				//atribui valor vazio ao edittext login e senha
                                login.setText("");
                                senha.setText("");
                            }
                        }
                    });
        }
    }
    //Metodo para validar os campos
    private boolean validarCampos() {
	//atribui valor falso, ou seja, errado
        boolean retorno = false;
	
	//verifica se os campos estão vazios
        if (!TextUtils.isEmpty(loginx) && !TextUtils.isEmpty(senhax)) {
	    //verifica se estar no formato de email
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(loginx).matches()) {
		    //se tudo estiver correto, atribui valor verdadeiro
                    retorno = true;
	    //caso contrario
            } else {
		//chama o metodo alerta e mostra na tela
                metodo.alerta("Formato inválido!", LoginActivity.this);

		//atribui valor vazio
                login.setText("");

		//aponta o erro
                login.setError("*");

		//foca no edittext
                login.requestFocus();
            }
        } else {
	    //chama o metodo alerta e mostra na tela
            metodo.alerta("Preencha todos os campos!", LoginActivity.this);
        }
	//retorna se os campos estão corretos ou não
        return retorno;
    }
    //metodo resultado falar
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
	
	//atraves do código verifica as opções
        switch (requestCode){
            case ID_TEXTO_PARA_VOZ:
		//captura o que foi falado e transcreve em texto no campo focado
                if (resultCode == RESULT_OK && null != data){
                    ArrayList<String> resultado = data
                            .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                    String ditado = resultado.get(0);
                    campo.setText(ditado);
                }
                break;
        }
    }

    //metodo botao voltar 
    @Override
    public void onBackPressed() {
        super.onBackPressed();
	//finaliza a activity
        LoginActivity.this.finish();
    }
}
