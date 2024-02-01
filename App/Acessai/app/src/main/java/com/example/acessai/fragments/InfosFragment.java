package com.example.acessai.fragments;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;

public class InfosFragment extends Fragment {

    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private final String HOST_SITE = new Host().getUrlSite();

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_infos, container, false);
        final Context context = inflater.getContext();

        ImageButton sobreNos = (ImageButton) view.findViewById(R.id.btnImgSobre);
        ImageButton contato = (ImageButton) view.findViewById(R.id.btnImgContato);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        sobreNos.setOnClickListener(v -> {
            Uri url = Uri.parse(HOST_SITE + "/sobre.php");
            Intent intent = new Intent(Intent.ACTION_VIEW, url);
            startActivity(intent);
        });

        contato.setOnClickListener(v -> {
            Uri url = Uri.parse(HOST_SITE + "/contato.php");
            Intent intent = new Intent(Intent.ACTION_VIEW, url);
            startActivity(intent);
        });

        utils.showLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

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
}