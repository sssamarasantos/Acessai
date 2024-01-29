package com.example.acessai.adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import androidx.recyclerview.widget.RecyclerView;

import com.example.acessai.R;
import com.example.acessai.activitys.HomeActivity;
import com.example.acessai.activitys.MainActivity;
import com.example.acessai.classes.Cronograma;
import com.example.acessai.classes.Metodos;
import com.example.acessai.fragments.CriarCronoFragment;
import com.example.acessai.fragments.CronogramaFragment;
import com.example.acessai.fragments.VideoaulaFragment;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.List;

public class ListaAdapterCrono extends BaseAdapter {

    private Context context;
    private List<Cronograma> cronograma;
    private String host = "http://acessai1.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret = "";
    boolean dadosValidados;
    Metodos metodo = new Metodos();

    public ListaAdapterCrono(Context con, List<Cronograma> cronograma) {
        this.context = con;
        this.cronograma = cronograma;
    }

    @Override
    public int getCount() {
        return this.cronograma.size();
    }

    @Override
    public Object getItem(int position) {
        return this.cronograma.get(position);
    }

    @Override
    public long getItemId(int position) {
        return this.cronograma.get(position).getIdCronograma();
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

        idCrono = (cronograma.get(position).getIdCronograma());
        discCrono.setText(cronograma.get(position).getDisciplina());
        dataCrono.setText(cronograma.get(position).getData());
        horaCrono.setText(cronograma.get(position).getHora());
        videoCrono.setText(cronograma.get(position).getVideo());

        final String dt = dataCrono.getText().toString();
        final String hr = horaCrono.getText().toString();

        editar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                CriarCronoFragment cf = new CriarCronoFragment();
                Bundle bundle = new Bundle();
                bundle.putString("tipo", "editar");
                bundle.putInt("id", idCrono);
                bundle.putString("data", dt);
                bundle.putString("hora", hr);
                cf.setArguments(bundle);
                FragmentTransaction fragmentTransaction = ((HomeActivity)context).getSupportFragmentManager().beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, cf).commit();
            }
        });

        deletar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder builder = new AlertDialog.Builder(context);
                builder.setMessage("Tem certeza que deseja excluir?");
                builder.setTitle("Aviso");
                builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        deletarCrono(idCrono);
                    }
                });
                builder.setNegativeButton("Cancelar", null);
                builder.create().show();
            }
        });

        return view;
    }

    private void deletarCrono(int id) {
        url = host + "/deletarCrono.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id", String.valueOf(id))
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ret = result.get("status").getAsString();
                        if (ret.equals("ok")) {
                            //metodo.alerta("Excluído com sucesso", context);
                            AlertDialog.Builder builder = new AlertDialog.Builder(context);
                            builder.setMessage("Excluído com sucesso!");
                            builder.setTitle("Aviso");
                            builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                        @Override
                                        public void onClick(DialogInterface dialog, int which) {
                                            FragmentTransaction fragmentTransaction = ((HomeActivity)context).getSupportFragmentManager().beginTransaction();
                                            fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).commit();
                                }
                            });
                            builder.create().show();
                        } else {
                            metodo.alerta("Algo deu errado :(", context);
                        }
                    }
                });
    }
}