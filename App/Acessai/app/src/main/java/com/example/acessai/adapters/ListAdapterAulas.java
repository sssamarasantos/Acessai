package com.example.acessai.adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckedTextView;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.acessai.R;
import com.example.acessai.classes.Videoaulas;

import java.util.List;

public class ListAdapterAulas extends BaseAdapter {

    private Context context;
    private List<Videoaulas> videoaulas;

    public ListAdapterAulas(Context context, List<Videoaulas> videoaulas) {
        this.context = context;
        this.videoaulas = videoaulas;
    }

    @Override
    public int getCount() {
        return this.videoaulas.size();
    }

    @Override
    public Object getItem(int position) {
        return this.videoaulas.get(position);
    }

    @Override
    public long getItemId(int position) {
        return this.videoaulas.get(position).getIdVideoaula();
    }

    @SuppressLint("ViewHolder")
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        View view;
        view = View.inflate(context, R.layout.list_adapter_aulas, null);
        TextView nomeAula = (TextView) view.findViewById(R.id.lblAula);

        nomeAula.setText(videoaulas.get(position).getNomeVideoaula());

        return view;
    }
}
