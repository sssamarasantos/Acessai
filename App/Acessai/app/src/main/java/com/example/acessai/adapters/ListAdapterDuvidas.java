//pacote
package com.example.acessai.adapters;
//classes importadas
import android.annotation.SuppressLint;
import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.acessai.R;
import com.example.acessai.classes.Duvidas;

import java.util.List;
//classe do adapter
public class ListAdapterDuvidas extends BaseAdapter {
    //declaracao das variaveis
    private List<Duvidas> duvidas;
    private Context context;
    //metodo construtor
    public ListAdapterDuvidas(Context context, List<Duvidas> duvidas) {
	//atribui o contexto
        this.context = context;
        //atribui os valores do listarray
        this.duvidas = duvidas;
    }
    //tamanho do array
    @Override
    public int getCount() {
        return this.duvidas.size();
    }
    //posição 
    @Override
    public Object getItem(int position) {
        return this.duvidas.get(position);
    }
    //id
    @Override
    public long getItemId(int position) {
        return this.duvidas.get(position).getIdDuvida();
    }
    //mostra a lista
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
	//instancia os elemementos
        @SuppressLint("ViewHolder") View view = View.inflate(context, R.layout.list_adapter_video, null);
        TextView aluno = (TextView) view.findViewById(R.id.txtAluno);
        TextView dataHoraMsg = (TextView) view.findViewById(R.id.txtDataHoraMsg);
        TextView mensagem = (TextView) view.findViewById(R.id.txtMsg);
        TextView prof = (TextView) view.findViewById(R.id.txtProf);
        TextView dataHoraResp = (TextView) view.findViewById(R.id.txtDataHoraResp);
        TextView resposta = (TextView) view.findViewById(R.id.txtResp);
	//atribui valores
        aluno.setText(duvidas.get(position).getNomeAluno());
        mensagem.setText(duvidas.get(position).getMsgDuvida());
        dataHoraMsg.setText(duvidas.get(position).getDataHoraMsg());
        prof.setText(duvidas.get(position).getNomeProf());
        resposta.setText(duvidas.get(position).getRespDuvida());
        dataHoraResp.setText(duvidas.get(position).getDataHoraResp());

        return view;
    }
}
