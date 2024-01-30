package com.example.acessai.fragments;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.content.Context;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.Spinner;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

public class CriarCronoFragment extends Fragment {

    private Spinner videos;
    private EditText hora, data;
    private DatePickerDialog datePickerDialog;
    private TimePickerDialog timePickerDialog;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private List<String> videoaulas;
    private ArrayAdapter<String> adaptador;
    private final String HOST_APP = new Host().getUrlApp();
    private String videosx, horax, datax;
    int idcrono;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_criar_crono, container, false);
        final Context context = inflater.getContext();

        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        videos = (Spinner) view.findViewById(R.id.spinner);
        hora = (EditText) view.findViewById(R.id.hora);
        data = (EditText) view.findViewById(R.id.data);
        ImageButton criar = (ImageButton) view.findViewById(R.id.btnCriar);
        ImageButton salvar = (ImageButton) view.findViewById(R.id.btnSalvar);
        ImageButton eData = (ImageButton) view.findViewById(R.id.btnEscolherData);
        ImageButton eHora = (ImageButton) view.findViewById(R.id.btnEscolherHora);
        videoaulas = new ArrayList<>();

        salvar.setVisibility(View.INVISIBLE);

        assert this.getArguments() != null;
        String tipo = this.getArguments().getString("tipo");

        assert tipo != null;
        if (tipo.equals("editar")){
            criar.setVisibility(View.INVISIBLE);
            salvar.setVisibility(View.VISIBLE);
            idcrono = this.getArguments().getInt("id");
            data.setText(this.getArguments().getString("data"));
            hora.setText(this.getArguments().getString("hora"));
        }

        callVideoClass(context);
        utils.showLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        criar.setOnClickListener(v -> {
            videosx = videos.getSelectedItem().toString();
            horax = hora.getText().toString();
            datax = data.getText().toString();
            insertSchedule(context);
        });

        salvar.setOnClickListener(v -> {
            videosx = videos.getSelectedItem().toString();
            horax = hora.getText().toString();
            datax = data.getText().toString();
            updateSchedule(context);
        });

        eData.setOnClickListener(v -> {
            final Calendar calendar = Calendar.getInstance();
            int dia = calendar.get(Calendar.DAY_OF_MONTH);
            int mes = calendar.get(Calendar.MONTH);
            int ano = calendar.get(Calendar.YEAR);

            datePickerDialog = new DatePickerDialog(context, (view1, year, month, dayOfMonth) -> data.setText(dayOfMonth + "/" + (month + 1) + "/" + year), ano, mes, dia);
            datePickerDialog.show();
        });

        eHora.setOnClickListener(v -> {
            final Calendar calendar1 = Calendar.getInstance();
            final int horaa = calendar1.get(Calendar.HOUR_OF_DAY);
            int minutos = calendar1.get(Calendar.MINUTE);

            timePickerDialog = new TimePickerDialog(context, (view12, hourOfDay, minute) ->
                    hora.setText(hourOfDay + ":" + minute), horaa, minutos, false);
            timePickerDialog.show();
        });

        libras.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (isChecked) {
                libras.setText("");
                frameLibras.setVisibility(View.VISIBLE);
                //video
                String videoPath = "android.resource://" + context.getPackageName() + "/" + R.raw.video_demonstrar;
                utils.showVideo(videoLibras, videoPath);
            } else {
                libras.setText("");
                frameLibras.setVisibility(View.INVISIBLE);
            }
        });
        return view;
    }

    private void callVideoClass(final Context context){
        String url = HOST_APP + "/chamarVideoaulas.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("assistencia", HomeFragment.assistenciaAluno)
                .asJsonArray()
                .setCallback((e, result) -> {
                    for (int i = 0; i < result.size(); i++){
                        JsonObject response = result.get(i).getAsJsonObject();
                        videoaulas.add(response.get("NOME_VIDEOAULA").getAsString());
                    }
                    adaptador = new ArrayAdapter<>(context, android.R.layout.simple_spinner_item, videoaulas);
                    adaptador.setDropDownViewResource(android.R.layout.simple_spinner_item);
                    videos.setAdapter(adaptador);
                });
    }

    private void insertSchedule(final Context context){
        boolean isValidData = validateFields();

        if (isValidData) {
            String url = HOST_APP + "/inserirCrono.php";

            Ion.with(context)
                    .load(url)
                    .setBodyParameter("hora_crono", horax)
                    .setBodyParameter("dta_crono", datax)
                    .setBodyParameter("id_aluno", HomeFragment.idAluno)
                    .setBodyParameter("nome_videoaula", videosx)
                    .asJsonObject()
                    .setCallback((e, result) -> {
                        String status = result.get("status").getAsString();
                        if (status.equals("ok")) {
                            AlertDialog.Builder builder = new AlertDialog.Builder(context);
                            builder.setMessage("Criado com sucesso!");
                            builder.setTitle("Aviso");
                            builder.setPositiveButton("OK", (dialog, which) -> {

                                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                                fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).commit();
                            });
                            builder.create().show();
                        } else {
                            utils.showAlert("Algo deu errado :(", context);
                            data.setText("");
                            hora.setText("");
                        }
                    });
        }
    }

    private void updateSchedule(final  Context context){
        boolean isValidData = validateFields();

        if (isValidData) {
            String url = HOST_APP + "/alterarCrono.php";

            Ion.with(context)
                    .load(url)
                    .setBodyParameter("hora_crono", horax)
                    .setBodyParameter("dta_crono", datax)
                    .setBodyParameter("id_crono", String.valueOf(idcrono))
                    .setBodyParameter("nome_videoaula", videosx)
                    .asJsonObject()
                    .setCallback((e, result) -> {
                        String status = result.get("status").getAsString();
                        if (status.equals("ok")) {
                            AlertDialog.Builder builder = new AlertDialog.Builder(context);
                            builder.setMessage("Alterado com sucesso!");
                            builder.setTitle("Aviso");
                            builder.setPositiveButton("OK", (dialog, which) -> {

                                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                                fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).commit();
                            });
                            builder.create().show();
                        } else {
                            utils.showAlert("Algo deu errado :(", getContext());
                        }
                    });
        }
    }

    private boolean validateFields() {
        boolean isValid = false;

        if (!TextUtils.isEmpty(datax) && !TextUtils.isEmpty(horax)) {
            isValid = true;
        } else {
            utils.showAlert("Preencha todos os campos!", getContext());
        }

        return isValid;
    }
}