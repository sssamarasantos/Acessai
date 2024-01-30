package com.example.acessai.activitys;

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

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
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
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private String HOST = new Host().getHost();
    private final int ID_TEXTO_PARA_VOZ = 100;

    Utils utils = new Utils();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_esqueceu_senha);

        falar = (ImageButton) findViewById(R.id.btnImgFalar);
        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        frameLibras = (FrameLayout) findViewById(R.id.frameLibras);
        libras = (ToggleButton) findViewById(R.id.tbLibras);
        email = (EditText) findViewById(R.id.txtEmailE);
        enviar = (Button) findViewById(R.id.btnEnviar);

        //Evento botao enviar
        enviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                forgotPassword(email.getText().toString());
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
                    utils.showAlert("Dispositivo não suporta!", EsqueceuSenhaActivity.this);
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
                    utils.showVideo(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
    }

    private void forgotPassword(String emailf) {
        boolean isValidData = validateFields(emailf);
        if (isValidData) {
            String url = HOST + "/recuperarSenha.php";
            Ion.with(EsqueceuSenhaActivity.this)
                    .load(url)
                    .setBodyParameter("email", emailf)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            String status = result.get("status").getAsString();
                            switch (status) {
                                case "ok":
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
                                    break;
                                case "vazio":
                                    utils.showAlert("Email não cadastrado :(", EsqueceuSenhaActivity.this);
                                    break;
                                case "erro":
                                    utils.showAlert("Algo deu errado :(", EsqueceuSenhaActivity.this);
                                    email.setText("");
                                    break;
                            }
                        }
                    });
        }
    }
    private boolean validateFields(String emailf) {
        boolean isValid = false;

        if (!TextUtils.isEmpty(emailf)) {
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(emailf).matches()) {
                isValid = true;
            } else {
                utils.showAlert("Formato inválido!", EsqueceuSenhaActivity.this);
                email.setText("");
                email.setError("*");
                email.requestFocus();
            }
        } else {
            utils.showAlert("Preencha todos os campos!", EsqueceuSenhaActivity.this);
            email.setError("*");
            email.requestFocus();
        }
        return isValid;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == ID_TEXTO_PARA_VOZ) {
            if (resultCode == RESULT_OK && null != data) {
                ArrayList<String> result = data
                        .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                assert result != null;
                String saying = result.get(0);
                email.setText(saying);
            }
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent intent = new Intent(EsqueceuSenhaActivity.this, LoginActivity.class);
        startActivity(intent);
        EsqueceuSenhaActivity.this.finish();
    }
}
