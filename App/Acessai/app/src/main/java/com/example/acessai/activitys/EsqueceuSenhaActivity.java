package com.example.acessai.activitys;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.ActivityNotFoundException;
import android.content.DialogInterface;
import android.content.Intent;
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
import com.example.acessai.fragments.HomeFragment;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.Locale;

public class EsqueceuSenhaActivity extends AppCompatActivity {

    private EditText email;
    private Button enviar;
    private ImageButton falar;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private String host = "http://acessai.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret = "";
    private String emailx;
    private boolean dadosValidados;
    private final int ID_TEXTO_PARA_VOZ = 100;

    Metodos metodo = new Metodos();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_esqueceu_senha);

        falar = (ImageButton) findViewById(R.id.btnImgFalar);
        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        frameLogin = (FrameLayout) findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) findViewById(R.id.frameLibras);
        libras = (ToggleButton) findViewById(R.id.tbLibras);
        email = (EditText) findViewById(R.id.txtEmailE);
        enviar = (Button) findViewById(R.id.btnEnviar);

        //Evento botao enviar
        enviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                emailx = email.getText().toString();
                esqueceuSenha();
            }
        });

        falar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent iVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
                iVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
                iVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
                iVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

                try {
                    startActivityForResult(iVoz, ID_TEXTO_PARA_VOZ);
                } catch (ActivityNotFoundException a){
                    metodo.alerta("Dispositivo não suporta!", EsqueceuSenhaActivity.this);
                }
            }
        });

        frameLibras.setVisibility(View.INVISIBLE);

        libras.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked) {
                    libras.setText("");
                    frameLibras.setVisibility(View.VISIBLE);
                    //video
                    String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video_tela_esqueceu;
                    metodo.video(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
    }

    private void esqueceuSenha() {
        dadosValidados = validarCampos();
        if (dadosValidados) {
            url = host + "/recuperarSenha.php";
            Ion.with(EsqueceuSenhaActivity.this)
                    .load(url)
                    .setBodyParameter("email", emailx)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            ret = result.get("status").getAsString();
                            if (ret.equals("ok")) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(EsqueceuSenhaActivity.this);
                                builder.setMessage("Email enviado com sucesso!");
                                builder.setTitle("Aviso");
                                builder.setNeutralButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {
                                        Intent objEsquece = new Intent(EsqueceuSenhaActivity.this, LoginActivity.class);
                                        startActivity(objEsquece);
                                        EsqueceuSenhaActivity.this.finish();
                                    }
                                });
                                builder.create().show();
                            }
                            if (ret.equals("vazio")){
                                metodo.alerta("Email não cadastrado :(", EsqueceuSenhaActivity.this);
                            }
                            if (ret.equals("erro")){
                                metodo.alerta("Algo deu errado :(", EsqueceuSenhaActivity.this);
                                email.setText("");
                            }
                        }
                    });
        }
    }
    private boolean validarCampos() {
        boolean retorno = false;

        if (!TextUtils.isEmpty(emailx)) {
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(emailx).matches()) {
                retorno = true;
            } else {
                metodo.alerta("Formato inválido!", EsqueceuSenhaActivity.this);
                email.setText("");
                email.setError("*");
                email.requestFocus();
            }
        } else {
            metodo.alerta("Preencha todos os campos!", EsqueceuSenhaActivity.this);
            email.setError("*");
            email.requestFocus();
        }
        return retorno;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        switch (requestCode){
            case ID_TEXTO_PARA_VOZ:
                if (resultCode == RESULT_OK && null != data){
                    ArrayList<String> resultado = data
                            .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                    String ditado = resultado.get(0);

                    email.setText(ditado);
                }
                break;
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent objEsquece = new Intent(EsqueceuSenhaActivity.this, LoginActivity.class);
        startActivity(objEsquece);
        EsqueceuSenhaActivity.this.finish();
    }
}
