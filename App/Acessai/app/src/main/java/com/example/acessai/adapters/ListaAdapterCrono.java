package com.example.acessai.adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.activitys.HomeActivity;
import com.example.acessai.classes.Cronograma;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.example.acessai.fragments.CriarCronoFragment;
import com.example.acessai.fragments.CronogramaFragment;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.List;

public class ListaAdapterCrono extends BaseAdapter {

    private final Context context;
    private final List<Cronograma> cronogramas;
    private final String HOST_APP = new Host().getUrlApp();

    Utils utils = new Utils();

    public ListaAdapterCrono(Context context, List<Cronograma> cronogramas) {
        this.context = context;
        this.cronogramas = cronogramas;
    }

    @Override
    public int getCount() {
        return this.cronogramas.size();
    }

    @Override
    public Object getItem(int position) {
        return this.cronogramas.get(position);
    }

    @Override
    public long getItemId(int position) {
        return this.cronogramas.get(position).getIdCronograma();
    }

    @SuppressLint("ViewHolder")
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        View view;
        view = View.inflate(context, R.layout.list_adapter_crono, null);
        TextView discCrono = (TextView) view.findViewById(R.id.lblDisciplinaVideo);
        final TextView dataCrono = (TextView) view.findViewById(R.id.lblDataVideo);
        final TextView horaCrono = (TextView) view.findViewById(R.id.lblhoraVideo);
        final TextView videoCrono = (TextView) view.findViewById(R.id.lblNomeVideo);
        ImageView deletar = (ImageView) view.findViewById(R.id.btnImgDeletar);
        final ImageView editar = (ImageView) view.findViewById(R.id.btnImgEditar);
        final int idCrono;

        idCrono = (cronogramas.get(position).getIdCronograma());
        discCrono.setText(cronogramas.get(position).getDisciplina());
        dataCrono.setText(cronogramas.get(position).getData());
        horaCrono.setText(cronogramas.get(position).getHora());
        videoCrono.setText(cronogramas.get(position).getVideo());

        final String dt = dataCrono.getText().toString();
        final String hr = horaCrono.getText().toString();

        editar.setOnClickListener(v -> {
            CriarCronoFragment cf = new CriarCronoFragment();
            Bundle bundle = new Bundle();
            bundle.putString("tipo", "editar");
            bundle.putInt("id", idCrono);
            bundle.putString("data", dt);
            bundle.putString("hora", hr);
            cf.setArguments(bundle);
            FragmentTransaction fragmentTransaction = ((HomeActivity)context).getSupportFragmentManager().beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, cf).commit();
        });

        deletar.setOnClickListener(v -> {
            AlertDialog.Builder builder = new AlertDialog.Builder(context);
            builder.setMessage("Tem certeza que deseja excluir?");
            builder.setTitle("Aviso");
            builder.setPositiveButton("OK", (dialog, which) -> deleteCrono(idCrono));
            builder.setNegativeButton("Cancelar", null);
            builder.create().show();
        });

        return view;
    }

    private void deleteCrono(int id) {
        String url = HOST_APP + "/deletarCrono.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id", String.valueOf(id))
                .asJsonObject()
                .setCallback((e, result) -> {
                    String status = result.get("status").getAsString();
                    if (status.equals("ok")) {
                        //metodo.alerta("Excluído com sucesso", context);
                        AlertDialog.Builder builder = new AlertDialog.Builder(context);
                        builder.setMessage("Excluído com sucesso!");
                        builder.setTitle("Aviso");
                        builder.setPositiveButton("OK", (dialog, which) -> {
                            FragmentTransaction fragmentTransaction = ((HomeActivity)context).getSupportFragmentManager().beginTransaction();
                            fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).commit();
                        });
                        builder.create().show();
                    } else {
                        utils.showAlert("Algo deu errado :(", context);
                    }
                });
    }
}