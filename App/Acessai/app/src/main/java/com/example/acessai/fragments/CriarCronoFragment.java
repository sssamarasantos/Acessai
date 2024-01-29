package com.example.acessai.fragments;

import android.annotation.SuppressLint;
import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.CompoundButton;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.Spinner;
import android.widget.TimePicker;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Metodos;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

public class CriarCronoFragment extends Fragment {

    private Spinner videos;
    private EditText hora, data;
    private ImageButton criar, salvar, eHora, eData;
    private DatePickerDialog datePickerDialog;
    private TimePickerDialog timePickerDialog;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private List<String> videoaulas;
    private ArrayAdapter<String> adaptador;
    private String host = "http://acessai1.000webhostapp.com/app/";
    private String url = "", ret = "", videosx, horax, datax;
    Metodos metodo = new Metodos();
    boolean dadosValidados;
    int idcrono;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_criar_crono, container, false);
        final Context context = inflater.getContext();

        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        videos = (Spinner) view.findViewById(R.id.spinner);
        hora = (EditText) view.findViewById(R.id.hora);
        data = (EditText) view.findViewById(R.id.data);
        criar = (ImageButton) view.findViewById(R.id.btnCriar);
        salvar = (ImageButton) view.findViewById(R.id.btnSalvar);
        eData = (ImageButton) view.findViewById(R.id.btnEscolherData);
        eHora = (ImageButton) view.findViewById(R.id.btnEscolherHora);
        videoaulas = new ArrayList<String>();

        salvar.setVisibility(View.INVISIBLE);

        String tipo = this.getArguments().getString("tipo");

        if (tipo.equals("editar")){
            criar.setVisibility(View.INVISIBLE);
            salvar.setVisibility(View.VISIBLE);
            idcrono = this.getArguments().getInt("id");
            data.setText(this.getArguments().getString("data"));
            hora.setText(this.getArguments().getString("hora"));
        }

        chamarVideoaulas(context);
        metodo.chamarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        criar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                videosx = videos.getSelectedItem().toString();
                horax = hora.getText().toString();
                datax = data.getText().toString();
                inserirCrono();
            }
        });

        salvar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                videosx = videos.getSelectedItem().toString();
                horax = hora.getText().toString();
                datax = data.getText().toString();
                alterarCrono();
            }
        });

        eData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendar = Calendar.getInstance();
                int dia = calendar.get(Calendar.DAY_OF_MONTH);
                int mes = calendar.get(Calendar.MONTH);
                int ano = calendar.get(Calendar.YEAR);

                datePickerDialog = new DatePickerDialog(context, new DatePickerDialog.OnDateSetListener() {
                    @SuppressLint("SetTextI18n")
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        data.setText(dayOfMonth + "/" + (month + 1) + "/" + year);
                    }
                }, ano, mes, dia);
                datePickerDialog.show();
            }
        });

        eHora.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendar1 = Calendar.getInstance();
                final int horaa = calendar1.get(Calendar.HOUR_OF_DAY);
                int minutos = calendar1.get(Calendar.MINUTE);

                timePickerDialog = new TimePickerDialog(context, new TimePickerDialog.OnTimeSetListener() {
                    @SuppressLint("SetTextI18n")
                    @Override
                    public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
                        hora.setText(hourOfDay + ":" + minute);
                    }
                }, horaa, minutos, false);
                timePickerDialog.show();
            }
        });

        libras.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked) {
                    libras.setText("");
                    frameLibras.setVisibility(View.VISIBLE);
                    //video
                    String videoPath = "android.resource://" + context.getPackageName() + "/" + R.raw.video_demonstrar;
                    metodo.video(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
        return view;
    }

    private void chamarVideoaulas(final Context con){
        url = host + "/chamarVideoaulas.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("assistencia", HomeFragment.assistenciaAluno)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();
                            videoaulas.add(ret.get("NOME_VIDEOAULA").getAsString());
                        }
                        adaptador = new ArrayAdapter<String>(con, android.R.layout.simple_spinner_item, videoaulas);
                        adaptador.setDropDownViewResource(android.R.layout.simple_spinner_item);
                        videos.setAdapter(adaptador);
                    }
                });
    }

    private void inserirCrono(){
        dadosValidados = validarCampos();

        if (dadosValidados) {
            url = host + "/inserirCrono.php";

            Ion.with(getContext())
                    .load(url)
                    .setBodyParameter("hora_crono", horax)
                    .setBodyParameter("dta_crono", datax)
                    .setBodyParameter("id_aluno", HomeFragment.idAluno)
                    .setBodyParameter("nome_videoaula", videosx)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            ret = result.get("status").getAsString();
                            if (ret.equals("ok")) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
                                builder.setMessage("Criado com sucesso!");
                                builder.setTitle("Aviso");
                                builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {

                                        FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                                        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                                        fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).commit();

                                        //Intent objLogin = new Intent(CriarCronoActivity.this, CronogramaActivity.class);
                                        //startActivity(objLogin);
                                        //CriarCronoActivity.this.finish();
                                    }
                                });
                                builder.create().show();
                            } else {
                                metodo.alerta("Algo deu errado :(", getContext());
                                data.setText("");
                                hora.setText("");
                            }
                        }
                    });
        }
    }

    private void alterarCrono(){
        dadosValidados = validarCampos();

        if (dadosValidados) {
            url = host + "/alterarCrono.php";

            Ion.with(getContext())
                    .load(url)
                    .setBodyParameter("hora_crono", horax)
                    .setBodyParameter("dta_crono", datax)
                    .setBodyParameter("id_crono", String.valueOf(idcrono))
                    .setBodyParameter("nome_videoaula", videosx)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            ret = result.get("status").getAsString();
                            if (ret.equals("ok")) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
                                builder.setMessage("Alterado com sucesso!");
                                builder.setTitle("Aviso");
                                builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {

                                        FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                                        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                                        fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).commit();

                                        //Intent objLogin = new Intent(CriarCronoActivity.this, CronogramaActivity.class);
                                        //startActivity(objLogin);
                                        //CriarCronoActivity.this.finish();
                                    }
                                });
                                builder.create().show();
                            } else {
                                metodo.alerta("Algo deu errado :(", getContext());
                            }
                        }
                    });
        }
    }

    private boolean validarCampos() {
        boolean retorno = false;

        if (!TextUtils.isEmpty(datax) && !TextUtils.isEmpty(horax)) {
            retorno = true;
        } else {
            metodo.alerta("Preencha todos os campos!", getContext());
        }
        return retorno;
    }
}